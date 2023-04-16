<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\Models\SMSNotifications;
use Validator;
use Illuminate\Support\Facades\DB;

class Notifications extends Controller 
{
   public function getRandomNotification(Request $request) {
      $sms = DB::table('SMSNotifications')
          ->select(
            'id',
            DB::raw("BillingMonth as Source"),
            DB::raw("CustomerId as SourceId"),
            'ContactNumber',
            'Message',
            'Status',
            DB::raw("NULL as AIFacilitator"),
            DB::raw("NULL as Notes"),
            )
          ->where('Status', 'PENDING')
          ->orderBy('created_at')
          ->first();

      if ($sms != null) {
          return response()->json($sms, 200);
      } else {
          return response()->json(['res' => 'No notifications found'], 404);
      }
  }

   public function updateSMSNotification(Request $request) {
      $id = $request['id'];
      $status = $request['Status'];

      SMSNotifications::where('id', $id)
         ->update(['Status' => $status]);

      return response()->json('ok', 200);
   }
}