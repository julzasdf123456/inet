<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AccountMastersController;
use App\Http\Controllers\API\AccountLinksController;
use App\Http\Controllers\API\BillsController;
use App\Http\Controllers\API\NotifiersController;
use App\Http\Controllers\API\VerificationController;
use App\Http\Controllers\API\ThirdPartyAPI;
use App\Http\Controllers\API\Notifications;
use App\Http\Controllers\API\OtherData;
use App\Http\Controllers\API\CustomersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// LOGIN AND REGISTER
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('logout', [UserController::class, 'logout']);
Route::post('reset-password', [UserController::class, 'resetPassword']);

// ACCOUNT MASTER
Route::get('get-account-by-account-master', [AccountMastersController::class, 'getAccountByAccountNumber']);
Route::post('update-contact-info', [AccountMastersController::class, 'updateContactInfo']);

// ACCOUNT LINKS
Route::get('get-linked-accounts', [AccountLinksController::class, 'getLinkedAccounts']);
Route::post('link-account', [AccountLinksController::class, 'linkAccount']);
Route::get('remove-link', [AccountLinksController::class, 'removeLink']);
Route::get('get-pending-accounts', [AccountLinksController::class, 'getPendingAccounts']);

// TOKEN
Route::post('insert-token', [UserController::class, 'insertToken']);

// BILLS
Route::get('get-latest-bills', [BillsController::class, 'getLatestBills']);
Route::get('get-unpaid-bills', [BillsController::class, 'getUnpaidBills']);
Route::get('get-bill-details', [BillsController::class, 'getBillDetails']);
Route::get('get-account-information', [BillsController::class, 'getAccountInformation']);
Route::get('get-previous-for-graph', [BillsController::class, 'getPreviousForGraph']);
Route::get('get-all-bill-by-year', [BillsController::class, 'getAllBillByYear']);

// Notifications
Route::get('get-notifications', [NotifiersController::class, 'getNotifications']);

// VERIFICATION
Route::get('send-sms-test', [VerificationController::class, 'sendSmsTest']);
Route::get('get-email-from-user', [VerificationController::class, 'getEmailFromUser']);


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', [UserController::class, 'details']);
});

/**
 * THIRD PARTY API
 */
Route::get('get-bill-by-account-and-period', [ThirdPartyAPI::class, 'getBillsByAccountAndPeriod']);
Route::post('transact', [ThirdPartyAPI::class, 'transact']);

/**
 * NOTIFICATIONS VIA SMS
 */
Route::get('get-random-notification', [Notifications::class, 'getRandomNotification']);
Route::get('update-sms', [Notifications::class, 'updateSMSNotification']);

/**
 * COLLECTORS APP
 */
Route::get('get-towns', [OtherData::class, 'getTowns']);
Route::get('get-barangays', [OtherData::class, 'getBarangays']);
Route::post('receive-customers', [OtherData::class, 'receiveCustomers']);
Route::post('receive-customers-technical', [OtherData::class, 'receiveCustomersTechnical']);
Route::post('receive-payment', [OtherData::class, 'receivePayment']);
Route::get('get-all-customers', [CustomersController::class, 'getAllCustomers']);
Route::get('get-all-customers-technical', [CustomersController::class, 'getAllCustomersTechnical']);
Route::get('get-all-bills', [CustomersController::class, 'getAllBills']);
Route::post('receive-bills', [OtherData::class, 'receiveBills']);

// ONLINE HUB
Route::get('get-account-by-account-number', [CustomersController::class, 'getAccountByAccountNumber']);
Route::get('get-latest-bills', [CustomersController::class, 'getLatestBills']);
Route::get('get-printable-bill', [CustomersController::class, 'getPrintableBill']);
Route::get('get-ticket-types-ajax', [CustomersController::class, 'getTicketTypesAjax']);
Route::post('insert-ticket', [CustomersController::class, 'insertTicket']);
