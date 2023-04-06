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

        $this->paymentTransactionsRepository->delete($id);

        Flash::success('Payment Transactions deleted successfully.');

        return redirect(route('paymentTransactions.index'));
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
}
