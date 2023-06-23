<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentTransactionsRequest;
use App\Http\Requests\UpdatePaymentTransactionsRequest;
use App\Repositories\PaymentTransactionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Towns;
use App\Models\Barangays;
use App\Models\Customers;
use App\Models\CustomerTechnical;
use App\Models\IDGenerator;
use App\Models\Billings;
use App\Models\PaymentTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class PaymentTransactionsController extends AppBaseController
{
    /** @var  PaymentTransactionsRepository */
    private $paymentTransactionsRepository;

    public function __construct(PaymentTransactionsRepository $paymentTransactionsRepo)
    {
        $this->middleware('auth');
        $this->paymentTransactionsRepository = $paymentTransactionsRepo;
    }

    /**
     * Display a listing of the PaymentTransactions.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $paymentTransactions = $this->paymentTransactionsRepository->all();

        return view('payment_transactions.index')
            ->with('paymentTransactions', $paymentTransactions);
    }

    /**
     * Show the form for creating a new PaymentTransactions.
     *
     * @return Response
     */
    public function create()
    {
        return view('payment_transactions.create');
    }

    /**
     * Store a newly created PaymentTransactions in storage.
     *
     * @param CreatePaymentTransactionsRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentTransactionsRequest $request)
    {
        $input = $request->all();

        $paymentTransactions = $this->paymentTransactionsRepository->create($input);

        Flash::success('Payment Transactions saved successfully.');

        return redirect(route('paymentTransactions.index'));
    }

    /**
     * Display the specified PaymentTransactions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentTransactions = $this->paymentTransactionsRepository->find($id);

        if (empty($paymentTransactions)) {
            Flash::error('Payment Transactions not found');

            return redirect(route('paymentTransactions.index'));
        }

        return view('payment_transactions.show')->with('paymentTransactions', $paymentTransactions);
    }

    /**
     * Show the form for editing the specified PaymentTransactions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentTransactions = $this->paymentTransactionsRepository->find($id);

        if (empty($paymentTransactions)) {
            Flash::error('Payment Transactions not found');

            return redirect(route('paymentTransactions.index'));
        }

        return view('payment_transactions.edit')->with('paymentTransactions', $paymentTransactions);
    }

    /**
     * Update the specified PaymentTransactions in storage.
     *
     * @param int $id
     * @param UpdatePaymentTransactionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentTransactionsRequest $request)
    {
        $paymentTransactions = $this->paymentTransactionsRepository->find($id);

        if (empty($paymentTransactions)) {
            Flash::error('Payment Transactions not found');

            return redirect(route('paymentTransactions.index'));
        }

        $paymentTransactions = $this->paymentTransactionsRepository->update($request->all(), $id);

        Flash::success('Payment Transactions updated successfully.');

        return redirect(route('paymentTransactions.index'));
    }

    /**
     * Remove the specified PaymentTransactions from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paymentTransactions = $this->paymentTransactionsRepository->find($id);

        if (empty($paymentTransactions)) {
            Flash::error('Payment Transactions not found');

            return redirect(route('paymentTransactions.index'));
        }

        $bill = Billings::where('CustomerId', $paymentTransactions->CustomerId)
            ->where('BillingMonth', $paymentTransactions->BillingMonth)
            ->first();

        if ($bill != null) {
            $amount = $paymentTransactions->AmountPaid;
            $bill->PaidAmount = floatval($bill->PaidAmount) - floatval($amount);
            $bill->Balance = floatval($bill->Balance) + floatval($amount);
            $bill->save();
        }

        $this->paymentTransactionsRepository->delete($id);

        // Flash::success('Payment Transactions deleted successfully.');

        // return redirect(route('paymentTransactions.index'));
        return response()->json('ok', 200);
    }

    public function transactBillsPayment(Request $request) {
        $billId = $request['BillId'];
        $amountPaid = $request['AmountPaid'];
        $orNumber = $request['ORNumber'];
        $paymentDate = $request['PaymentDate'];

        $bill = Billings::find($billId);
        if ($bill != null) {
            $customer = Customers::find($bill->CustomerId);

            $balance = $bill->Balance != null ? $bill->Balance : 0;
            $paidAmount = $bill->PaidAmount != null ? $bill->PaidAmount : 0;
            $amountPaid = floatval($amountPaid);

            $transactions = new PaymentTransactions;
            $transactions->id = IDGenerator::generateIDandRandString();
            $transactions->CustomerId = $customer->id;
            $transactions->CustomerName = $customer->FullName;
            $transactions->PaymentFor = 'Bills Payment';
            $transactions->ORNumber = $orNumber;
            $transactions->PaymentDate = $paymentDate;
            $transactions->BillingMonth = $bill->BillingMonth;
            $transactions->AmountPaid = $amountPaid;
            $transactions->UserId = Auth::id();
            $transactions->save();

            // UPDATE BILL
            if ($balance > $amountPaid) {
                $balance = $balance - $amountPaid;
                $bill->Balance = $balance;
                $bill->PaidAmount = $paidAmount + $amountPaid;
            } else {
                $bill->Balance = 0;
                $bill->PaidAmount = $bill->TotalAmountDue;
            } 

            $bill->save();
        } else {
            return response()->json('Bill not found', 404);
        }
    }

    public function monthlySales(Request $request) {
        $month = $request['Month'];
        $year = $request['Year'];
        $from = date('Y-m-d', strtotime('first day of ' . $month . ' ' . $year));
        $to = date('Y-m-d', strtotime('last day of ' . $month . ' ' . $year));

        if (isset($month) && isset($year)) {
            $data = DB::table('PaymentTransactions')
                ->leftJoin('Customers', 'PaymentTransactions.CustomerId', '=', 'Customers.id')
                ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
                ->leftJoin('users', 'users.id', '=', 'PaymentTransactions.UserId')
                ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
                ->select(
                    'FullName',
                    'Customers.id AS AccountNumber',
                    'Purok',
                    'Towns.Town',
                    'Barangays.Barangay',
                    'PaymentTransactions.BillingMonth',
                    'PaymentFor',
                    'AmountPaid',
                    'PaymentDate',
                    'users.name',
                    'PaymentTransactions.ORNumber',
                )
                ->orderBy('PaymentDate')
                ->get();

            $perCashier = DB::table('PaymentTransactions')
                ->leftJoin('users', 'users.id', '=', 'PaymentTransactions.UserId')
                ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
                ->select(
                    'users.name',
                    DB::raw("SUM(AmountPaid) AS TotalAmountPaid")
                )
                ->groupBy('users.name')
                ->orderBy('users.name')
                ->get();

            $perType = DB::table('PaymentTransactions')
                ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
                ->select(
                    'PaymentFor',
                    DB::raw("SUM(AmountPaid) AS TotalAmountPaid")
                )
                ->groupBy('PaymentFor')
                ->orderBy('PaymentFor')
                ->get();

            $perTown = DB::table('PaymentTransactions')
                ->leftJoin('Customers', 'PaymentTransactions.CustomerId', '=', 'Customers.id')
                ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
                ->select(
                    'Towns.Town',
                    DB::raw("SUM(AmountPaid) AS TotalAmountPaid")
                )
                ->groupBy('Towns.Town')
                ->orderBy('Towns.Town')
                ->get();

            $total = DB::table('PaymentTransactions')
                ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
                ->select(
                    DB::raw("SUM(AmountPaid) AS Total")
                )
                ->first();
        } else {
            $data = [];
            $perCashier = [];
            $perType = [];
            $total = null;
            $perTown = [];
        }       

        return view('/payment_transactions/monthly_sales', [
            'data' => $data,
            'perCashier' => $perCashier,
            'perType' => $perType,
            'total' => $total,
            'perTown' => $perTown,
        ]);
    }

    public function dashboardGraphData(Request $request) {
        $sales = DB::table('PaymentTransactions')
            ->select(
                DB::raw("CONVERT(NVARCHAR(7), PaymentDate, 120) [Month]"),
                DB::raw("SUM(AmountPaid) [SalesAmount]"),
                DB::raw("(SELECT SUM(Amount) FROM Expenses WHERE CONVERT(NVARCHAR(7), ExpenseDate, 120)=CONVERT(NVARCHAR(7), PaymentTransactions.PaymentDate, 120)) AS Expenses")
            )
            ->groupByRaw("CONVERT(NVARCHAR(7), PaymentDate, 120)")
            ->orderByRaw("CONVERT(NVARCHAR(7), PaymentDate, 120)")
            ->get();

        return response()->json($sales, 200);
    }

    public function payments(Request $request) {
        $param = $request['param'];
        if (isset($param)) {
            $data = DB::table('Customers')
                ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
                ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
                ->whereRaw("Trash IS NULL AND (FullName LIKE '%" . $param . "%' OR Customers.id LIKE '%" . $param . "%' OR Customers.ContactNumber LIKE '%" . $param . "%' OR CustomerTechnical.MacAddress LIKE '%" . $param . "%')")
                ->select(
                    'Customers.id',
                    'FullName',
                    'Towns.Town',
                    'Barangays.Barangay',
                    'Purok',
                    'ContactNumber',
                    'CustomerTechnical.MacAddress',
                    'CustomerTechnical.SpeedSubscribed',
                )
                ->paginate(50);
        } else {
            $data = [];
        }

        return view('/payment_transactions/payments', [
            'data' => $data
        ]);
    }

    public function paymentModule($id) {
        $customer = DB::table('Customers')
            ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
            ->leftJoin('users', 'users.id', '=', 'Customers.UserId')
            ->select(
                'FullName',
                'Customers.id',
                'Towns.Town',
                'Barangays.Barangay',
                'Purok',
                'Customers.Email',
                'ContactNumber',
                'DateConnected',
                'Status',
                'CustomerTechnicalId',
                'users.name',
                'Customers.created_at',
            )
            ->where('Customers.id', $id)
            ->first();

        $unpaidBills = Billings::where('CustomerId', $id)
            ->whereRaw("Balance > 0")
            ->orderByDesc("BillingMonth")
            ->get();

        return view('/payment_transactions/payment_module', [
            'customer' => $customer,
            'unpaidBills' => $unpaidBills,
        ]);
    }

    public function transactBillsPaymentBulk(Request $request) {
        $id = $request['id']; // customer id
        $amountPaid = $request['AmountPaid'];
        $orNumber = $request['ORNumber'];
        $amountPaid = floatval($amountPaid);

        $unpaidBills = Billings::where('CustomerId', $id)
            ->whereRaw("Balance > 0")
            ->orderBy("BillingMonth")
            ->get();

        $customer = DB::table('Customers')
            ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
            ->leftJoin('users', 'users.id', '=', 'Customers.UserId')
            ->select(
                'FullName',
                'Customers.id',
                'Towns.Town',
                'Barangays.Barangay',
                'Purok',
                'Customers.Email',
                'ContactNumber',
                'DateConnected',
                'Status',
                'CustomerTechnicalId',
                'users.name',
                'Customers.created_at',
            )
            ->where('Customers.id', $id)
            ->first();

        foreach($unpaidBills as $item) {
            if ($amountPaid > 0) {
                if (floatval($item->Balance) >= $amountPaid) {
                    $balance = floatval($item->Balance) - $amountPaid;
                    $item->Balance = $balance;
                    $item->PaidAmount = $item->PaidAmount + $amountPaid;
                    $item->save();

                    $transactions = new PaymentTransactions;
                    $transactions->id = IDGenerator::generateIDandRandString();
                    $transactions->CustomerId = $customer->id;
                    $transactions->CustomerName = $customer->FullName;
                    $transactions->PaymentFor = 'Bills Payment';
                    $transactions->ORNumber = $orNumber;
                    $transactions->PaymentDate = date('Y-m-d');
                    $transactions->BillingMonth = $item->BillingMonth;
                    $transactions->AmountPaid = $amountPaid;
                    $transactions->UserId = Auth::id();
                    $transactions->save();

                    $amountPaid = 0;
                } else {
                    $bal = $item->Balance;
                    $item->Balance = 0;
                    $item->PaidAmount = $item->PaidAmount + $bal;
                    $item->save();

                    $transactions = new PaymentTransactions;
                    $transactions->id = IDGenerator::generateIDandRandString();
                    $transactions->CustomerId = $customer->id;
                    $transactions->CustomerName = $customer->FullName;
                    $transactions->PaymentFor = 'Bills Payment';
                    $transactions->ORNumber = $orNumber;
                    $transactions->PaymentDate = date('Y-m-d');
                    $transactions->BillingMonth = $item->BillingMonth;
                    $transactions->AmountPaid = $bal;
                    $transactions->UserId = Auth::id();
                    $transactions->save();

                    $amountPaid = $amountPaid - floatval($bal);
                }
            }
        }

        return response()->json('ok', 200);
    }

    public function printPayment($orNumber, $custId) {        
        $customers = DB::table('Customers')
            ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
            ->leftJoin('users', 'users.id', '=', 'Customers.UserId')
            ->select(
                'FullName',
                'Customers.id',
                'Towns.Town',
                'Barangays.Barangay',
                'Purok',
                'Customers.Email',
                'ContactNumber',
                'DateConnected',
                'Status',
                'CustomerTechnicalId',
                'users.name',
                'Latitude',
                'Longitude',
                'Customers.created_at',
            )
            ->where('Customers.id', $custId)
            ->first();

        $payment = PaymentTransactions::where('ORNumber', $orNumber)->orderBy('created_at')->first();

        $payments = DB::table('PaymentTransactions')
                ->leftJoin('Billings', function($join) {
                    $join->on('PaymentTransactions.CustomerId', '=', 'Billings.CustomerId')                    
                        ->on('PaymentTransactions.BillingMonth', '=', 'Billings.BillingMonth');
                })
                ->whereRaw("ORNumber='" . $orNumber . "' AND PaymentTransactions.CustomerId='" . $custId . "'")
                ->select(
                    'PaymentTransactions.*',
                    'Billings.TotalAmountDue',
                    'Billings.PaidAmount',
                    'Billings.Balance',
                )
                ->orderBy('Billings.BillingMonth')
                ->get();

        $customersTechnical = CustomerTechnical::find($customers->CustomerTechnicalId);

        return view('/payment_transactions/print_payment', [
            'customer' => $customers,
            'payment' => $payment,
            'payments' => $payments,
            'customerTechnical' => $customersTechnical,
        ]);
    }
}
