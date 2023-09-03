<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStockHistoryRequest;
use App\Http\Requests\UpdateStockHistoryRequest;
use App\Repositories\StockHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\StockHistory;
use App\Models\Stocks;
use App\Models\IDGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class StockHistoryController extends AppBaseController
{
    /** @var  StockHistoryRepository */
    private $stockHistoryRepository;

    public function __construct(StockHistoryRepository $stockHistoryRepo)
    {
        $this->middleware('auth');
        $this->stockHistoryRepository = $stockHistoryRepo;
    }

    /**
     * Display a listing of the StockHistory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stockHistories = DB::table('StockHistory')
            ->leftJoin('Stocks', 'StockHistory.StockId', '=', 'Stocks.id')
            ->leftJoin('users', 'StockHistory.UserId', '=', 'users.id')
            ->select(
                'Stocks.StockName',
                'StockHistory.id',
                'Quantity',
                'name',
                'DateStocked',
            )
            ->orderBy('DateStocked')
            ->get();

        return view('stock_histories.index')
            ->with('stockHistories', $stockHistories);
    }

    /**
     * Show the form for creating a new StockHistory.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_histories.create');
    }

    /**
     * Store a newly created StockHistory in storage.
     *
     * @param CreateStockHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateStockHistoryRequest $request)
    {
        $input = $request->all();
        $input['id'] = IDGenerator::generateIDandRandString();
        $input['UserId'] = Auth::id();

        // UPDATE STOCK QUANTITY
        $stock = Stocks::find($input['StockId']);
        if ($stock != null) {
            $qty = $stock->StockQuantity != null ? floatval($stock->StockQuantity) : 0;
            $qty = $qty + floatval($input['Quantity']);
            $stock->StockQuantity = round($qty, 2);
            $stock->save();
        }

        $stockHistory = $this->stockHistoryRepository->create($input);

        Flash::success('Stock History saved successfully.');

        return redirect(route('stockHistories.index'));
    }

    /**
     * Display the specified StockHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        return view('stock_histories.show')->with('stockHistory', $stockHistory);
    }

    /**
     * Show the form for editing the specified StockHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        return view('stock_histories.edit')->with('stockHistory', $stockHistory);
    }

    /**
     * Update the specified StockHistory in storage.
     *
     * @param int $id
     * @param UpdateStockHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockHistoryRequest $request)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        $stockHistory = $this->stockHistoryRepository->update($request->all(), $id);

        Flash::success('Stock History updated successfully.');

        return redirect(route('stockHistories.index'));
    }

    /**
     * Remove the specified StockHistory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        $this->stockHistoryRepository->delete($id);

        Flash::success('Stock History deleted successfully.');

        return redirect(route('stockHistories.index'));
    }
}
