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
        $expenses = $this->expensesRepository->all();

        return view('expenses.index')
            ->with('expenses', $expenses);
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

    public function removeMyExpense($id)
    {
        $expenses = $this->expensesRepository->find($id);

        if (empty($expenses)) {
            Flash::error('Expenses not found');

            return redirect(route('expenses.index'));
        }

        $this->expensesRepository->delete($id);

        Flash::success('Expenses deleted successfully.');

        return redirect(route('expenses.my-expenses'));
    }
}
