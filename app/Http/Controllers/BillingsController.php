<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBillingsRequest;
use App\Http\Requests\UpdateBillingsRequest;
use App\Repositories\BillingsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Towns;
use App\Models\Barangays;
use App\Models\Customers;
use App\Models\CustomerTechnical;
use App\Models\IDGenerator;
use App\Models\Billings;
use App\Models\SMSNotifications;
use App\Models\PaymentTransactions;
use \DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class BillingsController extends AppBaseController
{
    /** @var  BillingsRepository */
    private $billingsRepository;

    public function __construct(BillingsRepository $billingsRepo)
    {
        $this->middleware('auth');
        $this->billingsRepository = $billingsRepo;
    }

    /**
     * Display a listing of the Billings.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $billings = $this->billingsRepository->all();

        return view('billings.index')
            ->with('billings', $billings);
    }

    /**
     * Show the form for creating a new Billings.
     *
     * @return Response
     */
    public function create()
    {
        return view('billings.create');
    }

    /**
     * Store a newly created Billings in storage.
     *
     * @param CreateBillingsRequest $request
     *
     * @return Response
     */
    public function store(CreateBillingsRequest $request)
    {
        $input = $request->all();

        $billings = $this->billingsRepository->create($input);

        Flash::success('Billings saved successfully.');

        return redirect(route('billings.index'));
    }

    /**
     * Display the specified Billings.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $billings = $this->billingsRepository->find($id);

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
                'Customers.created_at',
            )
            ->where('Customers.id', $billings->CustomerId)
            ->first();

        $paymentTransactions = DB::table('PaymentTransactions')
            ->leftJoin('users', 'PaymentTransactions.UserId', '=', 'users.id')
            ->where('BillingMonth', $billings->BillingMonth)
            ->where('CustomerId', $customers->id)
            ->select(
                'PaymentTransactions.*',
                'users.name'
            )
            ->orderByDesc('created_at')
            ->get();

        if (empty($billings)) {
            Flash::error('Billings not found');

            return redirect(route('billings.index'));
        }

        return view('billings.show', [
            'bill' => $billings,
            'customer' => $customers,
            'paymentTransactions' => $paymentTransactions,
        ]);
    }

    /**
     * Show the form for editing the specified Billings.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $billings = $this->billingsRepository->find($id);

        if (empty($billings)) {
            Flash::error('Billings not found');

            return redirect(route('billings.index'));
        }

        return view('billings.edit')->with('billings', $billings);
    }

    /**
     * Update the specified Billings in storage.
     *
     * @param int $id
     * @param UpdateBillingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBillingsRequest $request)
    {
        $billings = $this->billingsRepository->find($id);

        if (empty($billings)) {
            Flash::error('Billings not found');

            return redirect(route('billings.index'));
        }

        $pm = $billings->PaidAmount;
        $newAmnt = floatval($request['TotalAmountDue']);
        $newBal = $newAmnt - $pm;
        $request['Balance'] = $newBal;

        $billings = $this->billingsRepository->update($request->all(), $id);

        Flash::success('Billings updated successfully.');

        return redirect(route('billings.show', [$id]));
    }

    /**
     * Remove the specified Billings from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $billings = $this->billingsRepository->find($id);

        if (empty($billings)) {
            Flash::error('Billings not found');

            return redirect(route('billings.index'));
        }

        // $billings->Trash = 'Yes';

        $this->billingsRepository->delete($id);

        // Flash::success('Billings deleted successfully.');

        // return redirect(route('billings.index'));
        return response()->json('ok', 200);
    }

    public function autoGenerateBills() {
        // GET ALL CUSTOMERS FIRST
        $customers = DB::table('Customers')
            ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
            ->whereRaw("Trash IS NULL AND Status='ACTIVE'")
            ->select(
                'Customers.*',
                'CustomerTechnical.MonthlyPayment',
            )
            ->get();

        foreach($customers as $item) {
            $connectedDate = date('d', strtotime($item->DateConnected));
            $today = date('d');
            $billingMonth = date('Y-m-01', strtotime('today +1 month'));
            $billingDate = date('Y-m-d', strtotime('today +1 month'));

            // IF 
            if ($connectedDate == $today) {
                // CHECK IF BILL EXISTS IN THIS BILLING MONTH
                $checkBill = Billings::where('CustomerId', $item->id)
                    ->where('BillingMonth', $billingMonth)
                    ->whereRaw("Trash IS NULL")
                    ->first();

                if ($checkBill == null) {
                    // GENERATE BILL
                    $billings = new Billings;
                    $billings->id = IDGenerator::generateIDandRandString();
                    $billings->CustomerId = $item->id;
                    $billings->BillNumber = IDGenerator::generateID();
                    $billings->BillingMonth = $billingMonth;
                    $billings->BillingDate = $billingDate;
                    $billings->DueDate = date('Y-m-d', strtotime($billingDate . ' +1 month'));
                    $billings->BillAmountDue = $item->MonthlyPayment;
                    $billings->TotalAmountDue = $item->MonthlyPayment;
                    $billings->Balance = $item->MonthlyPayment;
                    $billings->save();
                }
            }
        }

        return response()->json('ok', 200);
    }

    public function autoGenerateBillsBulk() {
        // GET ALL CUSTOMERS FIRST
        $customers = DB::table('Customers')
            ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
            ->whereRaw("Trash IS NULL AND Status='ACTIVE'")
            ->select(
                'Customers.*',
                'CustomerTechnical.MonthlyPayment',
            )
            ->get();

        foreach($customers as $item) {
            $startDate = (new DateTime(date('Y-m-d', strtotime($item->DateConnected . ' +1 month'))));
            $endDate = (new DateTime(date('Y-m-d', strtotime('+1 month'))));

            $months = Billings::getMonthsFromDateConnected($startDate, $endDate);

            foreach ($months as $key => $value) {
                // CHECK IF BILL EXISTS IN THIS BILLING MONTH
                $checkBill = Billings::where('CustomerId', $item->id)
                    ->where('BillingMonth', $value)
                    ->whereRaw("Trash IS NULL")
                    ->first();

                if ($checkBill == null) {
                    $billingDate = date('Y-m-', strtotime($value)) . date('d', strtotime($item->DateConnected));
                    $dueDate = date('Y-m-', strtotime($value . ' +1 month')) . date('d', strtotime($item->DateConnected));
                    // GENERATE BILL
                    $billings = new Billings;
                    $billings->id = IDGenerator::generateIDandRandString();
                    $billings->CustomerId = $item->id;
                    $billings->BillNumber = IDGenerator::generateID();
                    $billings->BillingMonth = $value;
                    $billings->BillingDate = $billingDate;
                    $billings->DueDate = $dueDate;
                    $billings->BillAmountDue = $item->MonthlyPayment;
                    $billings->TotalAmountDue = $item->MonthlyPayment;
                    $billings->Balance = $item->MonthlyPayment;
                    $billings->save();
                }
            }
        }

        return response()->json('ok', 200);
    }

    public function allUnpaidBills(Request $request) {
        $data = DB::table('Billings')
            ->leftJoin('Customers', 'Billings.CustomerId', '=', 'Customers.id')
            ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
            ->whereRaw("Billings.Balance > 0")
            ->select(
                'Billings.*',
                'Customers.id AS AccountNumber',
                'Customers.FullName',
                'Towns.Town',
                'Barangays.Barangay',
                'Purok',
            )
            ->orderBy('Customers.id')
            ->orderBy('Billings.BillingMonth')
            ->get();

        return view('/billings/all_unpaid_bills', [
            'data' => $data,
        ]);
    }

    public function generateBillDueNotifs(Request $request) {
        $data = DB::table('Billings')
            ->leftJoin('Customers', 'Billings.CustomerId', '=', 'Customers.id')
            ->whereRaw("(DueDate BETWEEN GETDATE() AND dateadd(day, +5, convert(date, getdate()))) AND Balance > 0")
            ->select(
                'Customers.ContactNumber',
                'Customers.FullName',
                'Billings.Balance',
                'Billings.CustomerId',
                'Billings.BillingMonth',
                'Billings.DueDate'
            )
            ->get();

        foreach($data as $item) {
            $notifs = SMSNotifications::where('CustomerId', $item->CustomerId)
                ->where('BillingMonth', $item->BillingMonth)
                ->first();
            
            if ($notifs != null) {

            } else {
                $notifs = new SMSNotifications;
                $notifs->id = IDGenerator::generateIDandRandString();
                $notifs->ContactNumber = $item->ContactNumber;
                $notifs->Message = "Good day, MR/MS. " . $item->FullName . ', \n\nPlease be advised that your DJTAL internet payable amounting P ' . number_format($item->Balance, 2) .
                    " will due on " . date('M d, Y', strtotime($item->DueDate)) . ". Kindly settle the said amount to avoid disconnection. If you have already paid, kindly disregard this message. Thank you!";
                $notifs->CustomerId = $item->CustomerId;
                $notifs->BillingMonth = $item->BillingMonth;
                $notifs->Type = 'BILLS DUE';
                $notifs->Status = 'PENDING';
                $notifs->save();
            }
        }

        return response()->json('ok');
    }

    public function createBill(Request $request) {
        $accoutno = $request['AccountNo'];
        $month = $request['Month'];
        $year = $request['Year'];
        $period = $year . '-' . $month . '-01';

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
                'Customers.created_at',
            )
            ->where('Customers.id', $accoutno)
            ->first();

        $customersTechnical = CustomerTechnical::find($customers->CustomerTechnicalId);

        if ($customers != null && $customersTechnical != null) {
            // CHECK BILL
            $bill = Billings::where('CustomerId', $accoutno)
                ->where('BillingMonth', $period)
                ->first();

            if ($bill != null) {

            } else {
                $dueDate = date('Y-m-', strtotime($period . ' +1 month')) . date('d', strtotime($customers->DateConnected));

                $billings = new Billings;
                $billings->id = IDGenerator::generateIDandRandString();
                $billings->CustomerId = $accoutno;
                $billings->BillNumber = IDGenerator::generateID();
                $billings->BillingMonth = $period;
                $billings->BillingDate = date('Y-m-d');
                $billings->DueDate = $dueDate;
                $billings->BillAmountDue = $customersTechnical->MonthlyPayment;
                $billings->TotalAmountDue = $customersTechnical->MonthlyPayment;
                $billings->Balance = $customersTechnical->MonthlyPayment;
                $billings->save();
            }
        }

        return response()->json('ok', 200);
    }
    
    public function printBill($id) {
        $bill = Billings::find($id);
        
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
            ->where('Customers.id', $bill->CustomerId)
            ->first();

        $customersTechnical = CustomerTechnical::find($customers->CustomerTechnicalId);

        return view('/billings/print_bill', [
            'bill' => $bill,
            'customer' => $customers,
            'customerTechnical' => $customersTechnical,
        ]);
    }
}
