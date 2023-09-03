<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceConnectionCrew;
use App\Models\Towns;
use App\Models\Barangays;
use App\Models\Customers;
use App\Models\Billings;
use App\Models\CustomerTechnical;
use App\Models\PaymentTransactions;

class OtherData extends Controller {
    public $successStatus = 200;

    public function getTowns() {
        $towns = Towns::all();

        if ($towns == null) {
            return response()->json(['error' => 'No data'], 404); 
        } else {
            return response()->json($towns, $this->successStatus); 
        } 
    }

    public function getBarangays() {
        $barangays = Barangays::all();

        if ($barangays == null) {
            return response()->json(['error' => 'No data'], 404); 
        } else {
            return response()->json($barangays, $this->successStatus); 
        } 
    }

    public function getAllCrew() {
        $crew = ServiceConnectionCrew::all();

        if ($crew) {
            return response()->json($crew, $this->successStatus);
        } else {
            return response()->json(['response' => 'No data'], 404);
        }
    }

    public function receiveCustomers(Request $request) {
        $input = $request->all();
        $input['FullName'] = strtoupper($input['FullName']);
        $input['Purok'] = strtoupper($input['Purok']);

        $customers = Customers::create($input);

        return response()->json($customers, 200);
    }

    public function receiveCustomersTechnical(Request $request) {
        $input = $request->all();

        $customersTechnical = CustomerTechnical::create($input);

        return response()->json($customersTechnical, 200);
    }

    public function receivePayment(Request $request) {
        $input = $request->all();

        $payments = PaymentTransactions::create($input);

        return response()->json($payments, 200);
    }

    public function receiveBills(Request $request) {
        $input = $request->all();

        $bill = Billings::where('id', $input['id'])
            ->update([
                'PaidAmount' => $input['PaidAmount'],
                'Balance' => $input['Balance'],
            ]);

        $bill = Billings::find($input['id']);

        return response()->json($bill, 200);
    }
}