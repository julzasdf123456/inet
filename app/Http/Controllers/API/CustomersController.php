<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 
use App\Models\Customers;
use App\Models\CustomerTechnical;
use App\Models\Billings;
use Validator;

class CustomersController extends Controller {
   public $successStatus = 200;

   public function getAccountByAccountNumber(Request $request) {
      $acctNo = $request['acctNo'];

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
            ->where('Customers.id', $acctNo)
            ->first();

      $data = [];

      if ($customers != null) {
         $customersTechnical = CustomerTechnical::find($customers->CustomerTechnicalId);

         $data['FullName'] = $customers->FullName;
         $data['id'] = $customers->id;
         $data['Address'] = Customers::getAddress($customers);
         $data['Email'] = $customers->Email;
         $data['ContactNumber'] = $customers->ContactNumber;
         $data['DateConnected'] = $customers->DateConnected;
         $data['Status'] = $customers->Status;
         $data['CustomerTechnicalId'] = $customers->CustomerTechnicalId;
         $data['name'] = $customers->name;
         $data['Latitude'] = $customers->Latitude;
         $data['Longitude'] = $customers->Longitude;
         $data['created_at'] = $customers->created_at;
         $data['MonthlyPayment'] = $customersTechnical != null ? $customersTechnical->MonthlyPayment : 0;
         $data['SpeedSubscribed'] = $customersTechnical != null ? $customersTechnical->SpeedSubscribed : '';

         return response()->json($data, 200);
      } else {
         return response()->json('not found', 404);
      }
   }

   public function getLatestBills(Request $request) {
      $acctNo = $request['q'];

      $billings = Billings::where('CustomerId', $acctNo)
                ->orderByDesc('BillingMonth')
                ->get();

      return response()->json($billings, 200);
   }

   public function getPrintableBill(Request $request) {
      $id = $request['id'];

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

      $data = [];

      $data['FullName'] = $customers->FullName;
      $data['id'] = $customers->id;
      $data['Address'] = Customers::getAddress($customers);
      $data['Email'] = $customers->Email;
      $data['ContactNumber'] = $customers->ContactNumber;
      $data['DateConnected'] = $customers->DateConnected;
      $data['Status'] = $customers->Status;
      $data['CustomerTechnicalId'] = $customers->CustomerTechnicalId;
      $data['name'] = $customers->name;
      $data['Latitude'] = $customers->Latitude;
      $data['Longitude'] = $customers->Longitude;
      $data['created_at'] = $customers->created_at;
      $data['MonthlyPayment'] = $customersTechnical != null ? $customersTechnical->MonthlyPayment : 0;
      $data['SpeedSubscribed'] = $customersTechnical != null ? $customersTechnical->SpeedSubscribed : '';
      $data['BillNumber'] = $bill != null ? $bill->BillNumber : '';
      $data['BillingMonth'] = $bill != null ? $bill->BillingMonth : '';
      $data['BillingDate'] = $bill != null ? $bill->BillingDate : '';
      $data['DueDate'] = $bill != null ? $bill->DueDate : '';
      $data['TotalAmountDue'] = $bill != null ? $bill->TotalAmountDue : '';

      return response()->json($data, 200);
   }

   public function getAllCustomers() {
      $customers = DB::table('Customers')
            ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
            ->whereRaw("Trash IS NULL")
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
                'Latitude',
                'Longitude',
                'Customers.created_at',
                'Customers.Town AS TownId',
                'Customers.Barangay AS BarangayId'
            )
            ->get();

      $data = [];
      foreach($customers as $item) {
         array_push($data, [
            'FullName' => $item->FullName,
            'id' => $item->id,
            'Address' => Customers::getAddress($item),
            'Email' => $item->Email,
            'ContactNumber' => $item->ContactNumber,
            'DateConnected' => $item->DateConnected,
            'Status' => $item->Status,
            'CustomerTechnicalId' => $item->CustomerTechnicalId,
            'Latitude' => $item->Latitude,
            'Longitude' => $item->Longitude,
            'created_at' => $item->created_at,
            'Town' => $item->TownId,
            'Barangay' => $item->BarangayId,
            'Purok' => $item->Purok,
            'UploadStatus' => 'UPLOADED',
         ]);
      }

      return response()->json($data, 200);
   }

   public function getAllCustomersTechnical() {
      $customersTechnical = CustomerTechnical::all();

      $data = [];
      foreach($customersTechnical as $item) {
         array_push($data, [
            'id' => $item->id,
            'CustomerId' => $item->CustomerId,
            'SpeedSubscribed' => $item->SpeedSubscribed,
            'MonthlyPayment' => $item->MonthlyPayment,
            'MacAddress' => $item->MacAddress,
            'ModemId' => $item->ModemId,
            'ModemBrand' => $item->ModemBrand,
            'ModemNumber' => $item->ModemNumber,
            'UserId' => $item->UserId,
            'UploadStatus' => 'UPLOADED',
         ]);
      }

      return response()->json($data, 200);
   }

   public function getAllBills() {
      $bills = Billings::whereRaw("Trash IS NULL")->get();

      $data = [];
      foreach($bills as $item) {
         array_push($data, [
            'id' => $item->id,
            'BillNumber' => $item->BillNumber,
            'CustomerId' => $item->CustomerId,
            'BillingMonth' => $item->BillingMonth,
            'BillingDate' => $item->BillingDate,
            'DueDate' => $item->DueDate,
            'BillAmountDue' => $item->BillAmountDue,
            'AdditionalPayments' => $item->AdditionalPayments,
            'Deductions' => $item->Deductions,
            'TotalAmountDue' => $item->TotalAmountDue,
            'PaidAmount' => $item->PaidAmount,
            'Balance' => $item->Balance,
            'Notes' => $item->Notes,
            'SMSSent' => $item->SMSSent,
            'EmailSent' => $item->EmailSent,
            'Trash' => $item->Trash,
            'UploadStatus' => 'UPLOADED',
         ]);
      }

      return response()->json($data, 200);
   }
}