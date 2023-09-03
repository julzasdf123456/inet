<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStocksRequest;
use App\Http\Requests\UpdateStocksRequest;
use App\Repositories\StocksRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Stocks;
use App\Models\StockHistory;
use App\Models\IDGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class StocksController extends AppBaseController
{
    /** @var  StocksRepository */
    private $stocksRepository;

    public function __construct(StocksRepository $stocksRepo)
    {
        $this->middleware('auth');
        $this->stocksRepository = $stocksRepo;
    }

    /**
     * Display a listing of the Stocks.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stocks = $this->stocksRepository->all();

        return view('stocks.index')
            ->with('stocks', $stocks);
    }

    /**
     * Show the form for creating a new Stocks.
     *
     * @return Response
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created Stocks in storage.
     *
     * @param CreateStocksRequest $request
     *
     * @return Response
     */
    public function store(CreateStocksRequest $request)
    {
        $input = $request->all();

        $stocks = $this->stocksRepository->create($input);

        Flash::success('Stocks saved successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Stocks.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stocks = $this->stocksRepository->find($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }

        $history = DB::table("StockHistory")
            ->leftJoin('users', 'StockHistory.UserId', '=', 'users.id')
            ->where('StockId', $id)
            ->select('StockHistory.*', 'users.name')
            ->orderByDesc('created_at')
            ->get();

        return view('stocks.show', [
            'stocks' => $stocks,
            'history' => $history
        ]);
    }

    /**
     * Show the form for editing the specified Stocks.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stocks = $this->stocksRepository->find($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.edit')->with('stocks', $stocks);
    }

    /**
     * Update the specified Stocks in storage.
     *
     * @param int $id
     * @param UpdateStocksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStocksRequest $request)
    {
        $stocks = $this->stocksRepository->find($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }

        $stocks = $this->stocksRepository->update($request->all(), $id);

        Flash::success('Stocks updated successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Stocks from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stocks = $this->stocksRepository->find($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }

        $this->stocksRepository->delete($id);

        Flash::success('Stocks deleted successfully.');

        return redirect(route('stocks.index'));
    }

    public function addStocks(Request $request) {
        return view('/stocks/add_stocks', [
            'stocks' => Stocks::orderBy('StockName')->get(),
        ]);
    }

    /**
     * Store a newly created Stocks in storage.
     *
     * @param CreateStocksRequest $request
     *
     * @return Response
     */
    public function storeAjax(Request $request)
    {
        $input = $request->all();
        $input['id'] = IDGenerator::generateID();

        $stocks = $this->stocksRepository->create($input);

        return response()->json($stocks, 200);
    }
}
