<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpensesRequest;
use App\Http\Requests\UpdateExpensesRequest;
use App\Repositories\ExpensesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\IDGenerator;
use App\Models\Expenses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class ExpensesController extends AppBaseController
{
    /** @var  ExpensesRepository */
    private $expensesRepository;

    public function __construct(ExpensesRepository $expensesRepo)
    {
        $this->middleware('auth');
        $this->expensesRepository = $expensesRepo;
    }

    /**
     * Display a listing of the Expenses.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $month = isset($request['Month']) ? $request['Month'] : date('F');
        $year = $request['Year'];
        $from = date('Y-m-d', strtotime('first day of ' . $month . ' ' . $year));
        $to = date('Y-m-d', strtotime('last day of ' . $month . ' ' . $year));

        $data = DB::table('Expenses')
            ->leftJoin('users', 'Expenses.UserId', '=', 'users.id')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select('Expenses.*', 'users.name')
            ->orderBy('ExpenseDate')
            ->get();

        $perUser = DB::table('Expenses')
            ->leftJoin('users', 'Expenses.UserId', '=', 'users.id')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select(
                'users.name',
                DB::raw("SUM(Amount) AS Amount")
            )
            ->groupBy('users.name')
            ->orderBy('users.name')
            ->get();

        $total = DB::table('Expenses')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select(DB::raw("SUM(Amount) AS Total"))
            ->first();

        return view('/expenses/index', [
            'data' => $data,
            'total' => $total,
            'perUser' => $perUser
        ]);
    }

    /**
     * Show the form for creating a new Expenses.
     *
     * @return Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created Expenses in storage.
     *
     * @param CreateExpensesRequest $request
     *
     * @return Response
     */
    public function store(CreateExpensesRequest $request)
    {
        $input = $request->all();

        $expenses = $this->expensesRepository->create($input);

        Flash::success('Expenses saved successfully.');

        return redirect(route('expenses.index'));
    }

    /**
     * Store a newly created Expenses in storage.
     *
     * @param CreateExpensesRequest $request
     *
     * @return Response
     */
    public function storeAjax(Request $request)
    {
        $input = $request->all();
        $input['id'] = IDGenerator::generateIDandRandString();

        $expenses = $this->expensesRepository->create($input);

        return response()->json($expenses, 200);
    }

    /**
     * Display the specified Expenses.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expenses = $this->expensesRepository->find($id);

        if (empty($expenses)) {
            Flash::error('Expenses not found');

            return redirect(route('expenses.index'));
        }

        return view('expenses.show')->with('expenses', $expenses);
    }

    /**
     * Show the form for editing the specified Expenses.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expenses = $this->expensesRepository->find($id);

        if (empty($expenses)) {
            Flash::error('Expenses not found');

            return redirect(route('expenses.index'));
        }

        return view('expenses.edit')->with('expenses', $expenses);
    }

    /**
     * Update the specified Expenses in storage.
     *
     * @param int $id
     * @param UpdateExpensesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpensesRequest $request)
    {
        $expenses = $this->expensesRepository->find($id);

        if (empty($expenses)) {
            Flash::error('Expenses not found');

            return redirect(route('expenses.index'));
        }

        $expenses = $this->expensesRepository->update($request->all(), $id);

        Flash::success('Expenses updated successfully.');

        return redirect(route('expenses.index'));
    }

    /**
     * Remove the specified Expenses from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expenses = $this->expensesRepository->find($id);

        if (empty($expenses)) {
            Flash::error('Expenses not found');

            return redirect(route('expenses.index'));
        }

        $this->expensesRepository->delete($id);

        Flash::success('Expenses deleted successfully.');

        return redirect(route('expenses.index'));
    }

    public function myExpenses(Request $request) {
        $month = isset($request['Month']) ? $request['Month'] : date('F');
        $year = $request['Year'];
        $from = date('Y-m-d', strtotime('first day of ' . $month . ' ' . $year));
        $to = date('Y-m-d', strtotime('last day of ' . $month . ' ' . $year));

        $data = DB::table('Expenses')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "') AND UserId='" . Auth::id() . "'")
            ->select('*')
            ->orderBy('ExpenseDate')
            ->get();

        $total = DB::table('Expenses')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "') AND UserId='" . Auth::id() . "'")
            ->select(DB::raw("SUM(Amount) AS Total"))
            ->first();

        return view('/expenses/my_expenses', [
            'data' => $data,
            'total' => $total,
        ]);
    }

    public function removeMyExpense($id) {
        $expenses = $this->expensesRepository->find($id);

        if (empty($expenses)) {
            Flash::error('Expenses not found');

            return redirect(route('expenses.index'));
        }

        $this->expensesRepository->delete($id);

        Flash::success('Expenses deleted successfully.');

        return redirect(route('expenses.my-expenses'));
    }

    public function balanceSheet(Request $request) {
        $month = isset($request['Month']) ? $request['Month'] : date('F');
        $year = $request['Year'];
        $from = date('Y-m-d', strtotime('first day of ' . $month . ' ' . $year));
        $to = date('Y-m-d', strtotime('last day of ' . $month . ' ' . $year));

        $expensesConsolidated = DB::table('Expenses')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select('ExpenseFor',
                DB::raw("SUM(Amount) AS TotalConsolidatedExpenses")
                )
            ->groupBy('ExpenseFor')
            ->orderBy('ExpenseFor')
            ->get();

        $salesConsolidated = DB::table('PaymentTransactions')
            ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select(
                'PaymentFor',
                DB::raw("SUM(AmountPaid) AS TotalConsolidatedSales")
            )
            ->groupBy('PaymentFor')
            ->orderBy('PaymentFor')
            ->get();

        $expensesDetailed = DB::table('Expenses')
            ->leftJoin('users', 'Expenses.UserId', '=', 'users.id')
            ->whereRaw("(ExpenseDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select(
                'Expenses.*',
                'users.name'
            )
            ->orderBy('ExpenseDate')
            ->get();

        $salesDetailed = DB::table('PaymentTransactions')
            ->leftJoin('Customers', 'PaymentTransactions.CustomerId', '=', 'Customers.id')
            ->leftJoin('users', 'users.id', '=', 'PaymentTransactions.UserId')
            ->whereRaw("(PaymentTransactions.PaymentDate BETWEEN '" . $from . "' AND '" . $to . "')")
            ->select(
                'PaymentTransactions.*',
                'Customers.FullName',
                'users.name'
            )
            ->orderBy('PaymentDate')
            ->get();

        return view('/expenses/balance_sheet', [
            'expensesConsolidated' => $expensesConsolidated,
            'salesConsolidated' => $salesConsolidated,
            'expensesDetailed' => $expensesDetailed,
            'salesDetailed' => $salesDetailed,
        ]);
    }
}
