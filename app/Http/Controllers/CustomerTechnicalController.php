<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerTechnicalRequest;
use App\Http\Requests\UpdateCustomerTechnicalRequest;
use App\Repositories\CustomerTechnicalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\CustomerTechnical;
use App\Models\IDGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class CustomerTechnicalController extends AppBaseController
{
    /** @var  CustomerTechnicalRepository */
    private $customerTechnicalRepository;

    public function __construct(CustomerTechnicalRepository $customerTechnicalRepo)
    {
        $this->middleware('auth');
        $this->customerTechnicalRepository = $customerTechnicalRepo;
    }

    /**
     * Display a listing of the CustomerTechnical.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $customerTechnicals = $this->customerTechnicalRepository->all();

        return view('customer_technicals.index')
            ->with('customerTechnicals', $customerTechnicals);
    }

    /**
     * Show the form for creating a new CustomerTechnical.
     *
     * @return Response
     */
    public function create()
    {
        return view('customer_technicals.create');
    }

    /**
     * Store a newly created CustomerTechnical in storage.
     *
     * @param CreateCustomerTechnicalRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerTechnicalRequest $request)
    {
        $input = $request->all();
        $input['UserId'] = Auth::id();

        $customerTechnical = $this->customerTechnicalRepository->create($input);

        //change customer tech id
        $customer = Customers::find($input['CustomerId']);
        if ($customer != null) {
            $customer->CustomerTechnicalId = $input['id'];
            $customer->save();
        }

        Flash::success('Customer Technical saved successfully.');

        return redirect(route('customers.show', [$input['CustomerId']]));
    }

    /**
     * Display the specified CustomerTechnical.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customerTechnical = $this->customerTechnicalRepository->find($id);

        if (empty($customerTechnical)) {
            Flash::error('Customer Technical not found');

            return redirect(route('customerTechnicals.index'));
        }

        return view('customer_technicals.show')->with('customerTechnical', $customerTechnical);
    }

    /**
     * Show the form for editing the specified CustomerTechnical.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customerTechnical = $this->customerTechnicalRepository->find($id);

        if (empty($customerTechnical)) {
            Flash::error('Customer Technical not found');

            return redirect(route('customerTechnicals.index'));
        }

        return view('customer_technicals.edit')->with('customerTechnical', $customerTechnical);
    }

    /**
     * Update the specified CustomerTechnical in storage.
     *
     * @param int $id
     * @param UpdateCustomerTechnicalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerTechnicalRequest $request)
    {
        $customerTechnical = $this->customerTechnicalRepository->find($id);

        if (empty($customerTechnical)) {
            Flash::error('Customer Technical not found');

            return redirect(route('customerTechnicals.index'));
        }

        $customerTechnical = $this->customerTechnicalRepository->update($request->all(), $id);

        Flash::success('Customer Technical updated successfully.');

        return redirect(route('customerTechnicals.index'));
    }

    /**
     * Remove the specified CustomerTechnical from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customerTechnical = $this->customerTechnicalRepository->find($id);

        if (empty($customerTechnical)) {
            Flash::error('Customer Technical not found');

            return redirect(route('customerTechnicals.index'));
        }

        $this->customerTechnicalRepository->delete($id);

        Flash::success('Customer Technical deleted successfully.');

        return redirect(route('customerTechnicals.index'));
    }

    public function changeModem($custId) {
        $customer = Customers::find($custId);
        $customerTechnical = CustomerTechnical::find($customer->CustomerTechnicalId);

        return view('/customer_technicals/change_modem', [
            'customer' => $customer,
            'customerTechnical' => $customerTechnical,
        ]);
    }
}
