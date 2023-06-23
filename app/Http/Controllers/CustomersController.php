<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use App\Repositories\CustomersRepository;
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

class CustomersController extends AppBaseController
{
    /** @var  CustomersRepository */
    private $customersRepository;

    public function __construct(CustomersRepository $customersRepo)
    {
        $this->middleware('auth');
        $this->customersRepository = $customersRepo;
    }

    /**
     * Display a listing of the Customers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $param = $request['param'];
        $town = $request['Town'];

        if (isset($param)) {
            if ($town != 'All') {
                $data = DB::table('Customers')
                    ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
                    ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                    ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
                    ->whereRaw("Customers.Town='" . $town . "'")
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
                    ->paginate(100);
            } else {
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
                    ->paginate(100);
            }            
        } else {
            if ($town != 'All') {
                $data = DB::table('Customers')
                    ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
                    ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                    ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
                    ->whereRaw("Customers.Town='" . $town . "'")
                    ->whereRaw("Trash IS NULL")
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
                    ->paginate(200);
            } else {
                $data = DB::table('Customers')
                    ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
                    ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                    ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
                    ->whereRaw("Trash IS NULL")
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
                    ->paginate(25);
            }           
        }

        return view('customers.index', [
            'data' => $data,
            'towns' => Towns::orderBy('Town')->get(),
        ]);
    }

    /**
     * Show the form for creating a new Customers.
     *
     * @return Response
     */
    public function create()
    {
        return view('customers.create', [
            'towns' => Towns::orderBy('Town')->get(),
            'cond' => 'new',
            'customers' => null,
        ]);
    }

    /**
     * Store a newly created Customers in storage.
     *
     * @param CreateCustomersRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomersRequest $request)
    {
        $custTechId = IDGenerator::generateID();
        $input = $request->all();
        $input['FullName'] = strtoupper($input['FullName']);
        $input['Purok'] = strtoupper($input['Purok']);
        $input['UserId'] = Auth::id();
        $input['Status'] = 'ACTIVE';
        $input['CustomerTechnicalId'] = $custTechId;

        $customers = $this->customersRepository->create($input);

        // create customers technical
        $customersTechnical = new CustomerTechnical;
        $customersTechnical->id = $custTechId;
        $customersTechnical->CustomerId = $input['id'];
        $customersTechnical->SpeedSubscribed = $input['SpeedSubscribed'];
        $customersTechnical->MonthlyPayment = $input['MonthlyPayment'];
        $customersTechnical->MacAddress = $input['MacAddress'];
        $customersTechnical->ModemBrand = $input['ModemBrand']; 
        $customersTechnical->ModemNumber = $input['ModemNumber']; 
        $customersTechnical->UserId = Auth::id();
        $customersTechnical->save();

        // create installation fee
        $transactions = new PaymentTransactions;
        $transactions->id = IDGenerator::generateIDandRandString();
        $transactions->CustomerId = $input['id'];
        $transactions->CustomerName = $input['FullName'];
        $transactions->PaymentFor = 'Installation fee';
        $transactions->ORNumber = $input['ORNumber'];
        $transactions->PaymentDate = $input['PaymentDate'];
        $transactions->AmountPaid = $input['InstallationFee'];
        $transactions->UserId = Auth::id();
        $transactions->save();

        // create first billing
        $billings = new Billings;
        $billings->id = IDGenerator::generateIDandRandString();
        $billings->CustomerId = $input['id'];
        $billings->BillNumber = IDGenerator::generateID();
        $billings->BillingMonth = date('Y-m-01', strtotime($input['DateConnected'] . ' +1 month'));
        $billings->BillingDate = date('Y-m-d');
        $billings->DueDate = date('Y-m-d', strtotime($input['DateConnected'] . ' +1 month'));
        $billings->BillAmountDue = $input['MonthlyPayment'];
        $billings->TotalAmountDue = $input['MonthlyPayment'];
        $billings->Balance = $input['MonthlyPayment'];
        $billings->save();

        Flash::success('Customers saved successfully.');

        return redirect(route('customers.index'));
    }

    /**
     * Display the specified Customers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
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
            ->where('Customers.id', $id)
            ->first();

        $customersTechnical = CustomerTechnical::find($customers->CustomerTechnicalId);
        $modemHistory = DB::table('CustomerTechnical')
                ->leftJoin('users', 'CustomerTechnical.UserId', '=', 'users.id')
                ->whereRaw("CustomerId='" . $id . "'")
                ->select('CustomerTechnical.*', 'users.name')
                ->orderByDesc('CustomerTechnical.created_at')
                // ->offset(1)
                ->get();

        $billings = Billings::where('CustomerId', $id)
                ->orderByDesc('BillingMonth')
                ->get();

        $balance = DB::table('Billings')
                ->where('CustomerId', $id)
                ->select(
                    DB::raw("SUM(Balance) AS BalanceTotal")
                )
                ->first();

        $transactionHistory = DB::table('PaymentTransactions')
                ->leftJoin('users', 'PaymentTransactions.UserId', '=', 'users.id')
                ->where('CustomerId', $customers->id)
                ->select(
                    'PaymentTransactions.*',
                    'users.name'
                )
                ->orderByDesc('created_at')
                ->get();

        if (empty($customers)) {
            Flash::error('Customers not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show', [
            'customer' => $customers,
            'customerTechnical' => $customersTechnical,
            'modemHistory' => $modemHistory,
            'billings' => $billings,
            'balance' => $balance,
            'transactionHistory' => $transactionHistory,
        ]);
    }

    /**
     * Show the form for editing the specified Customers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customers = $this->customersRepository->find($id);

        if (empty($customers)) {
            Flash::error('Customers not found');

            return redirect(route('customers.index'));
        }

        return view('customers.edit', [
            'cond' => 'update',
            'towns' => Towns::orderBy('Town')->get(),
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified Customers in storage.
     *
     * @param int $id
     * @param UpdateCustomersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomersRequest $request)
    {
        $customers = $this->customersRepository->find($id);

        if (empty($customers)) {
            Flash::error('Customers not found');

            return redirect(route('customers.index'));
        }

        $customers = $this->customersRepository->update($request->all(), $id);

        Flash::success('Customers updated successfully.');

        return redirect(route('customers.show', [$id]));
    }

    /**
     * Remove the specified Customers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customers = $this->customersRepository->find($id);

        if (empty($customers)) {
            Flash::error('Customers not found');

            return redirect(route('customers.index'));
        }

        // $this->customersRepository->delete($id);
        $customers->Trash = 'Yes';
        $customers->UserId = Auth::id();
        $customers->save();

        Flash::success('Customers deleted successfully.');

        return redirect(route('customers.index'));
    }

    public function getDashboardStatistics() {
        $data = DB::table('Customers')
            ->select(
                DB::raw("(SELECT COUNT(id) FROM Customers WHERE Status='ACTIVE') AS TotalActiveCustomers"),
                DB::raw("(SELECT COUNT(id) FROM Customers WHERE Status='DISCONNECTED') AS TotalDisconnectedCustomers"),
                DB::raw("(SELECT COUNT(id) FROM Customers WHERE DateConnected BETWEEN '" . date('Y-m-d', strtotime('first day of this month')) . "' AND '" . date('Y-m-d', strtotime('last day of this month')) . "') AS NewCustomers"),
                DB::raw("(SELECT COUNT(id) FROM PaymentTransactions WHERE PaymentFor='Bills Payment' AND (PaymentDate BETWEEN '" . date('Y-m-d', strtotime('first day of this month')) . "' AND '" . date('Y-m-d', strtotime('last day of this month')) . "')) AS PaymentsThisMonth"),
            )
            ->first();

        return response()->json($data, 200);
    }

    public function trash() {
        $data = DB::table('Customers')
                ->leftJoin('CustomerTechnical', 'Customers.CustomerTechnicalId', '=', 'CustomerTechnical.id')
                ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
                ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
                ->leftJoin('users', 'Customers.Userid', '=', 'users.id')
                ->whereRaw("Trash='Yes'")
                ->select(
                    'Customers.id',
                    'FullName',
                    'Towns.Town',
                    'Barangays.Barangay',
                    'Purok',
                    'ContactNumber',
                    'CustomerTechnical.MacAddress',
                    'CustomerTechnical.SpeedSubscribed',
                    'Customers.updated_at',
                    'users.name'
                )
                ->get();

        return view('/customers/trash', [
            'data' => $data,
        ]);
    }

    public function restore($id) {
        Customers::where('id', $id)
            ->update(['Trash' => null]);

        Flash::success('Customer restored successfully.');

        return redirect(route('customers.trash'));
    }

}
