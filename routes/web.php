<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccountMasterController;
use App\Http\Controllers\AccountLinksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Account Links
Route::get('/account_links/approve-account-link/{id}', [AccountLinksController::class, 'approveAccountLink'])->name('accountLinks.approve-account-link');
Route::get('/account_links/reject-account-link/{id}', [AccountLinksController::class, 'rejectAccountLink'])->name('accountLinks.reject-account-link');

Route::resource('users', UsersController::class);
Route::resource('accountMasters', AccountMasterController::class);


Route::resource('accountMasters', App\Http\Controllers\AccountMasterController::class);

Route::resource('accountLinks', App\Http\Controllers\AccountLinksController::class);

Route::resource('tokens', App\Http\Controllers\TokensController::class);

Route::resource('bills', App\Http\Controllers\BillsController::class);

Route::resource('paidBills', App\Http\Controllers\PaidBillsController::class);

Route::resource('userAppLogs', App\Http\Controllers\UserAppLogsController::class);

Route::resource('notifiers', App\Http\Controllers\NotifiersController::class);

Route::get('/third_party_tokens/regenerate-token/{id}', [App\Http\Controllers\ThirdPartyTokensController::class, 'regenerateToken'])->name('thirdPartyTokens.regenerate-token');
Route::resource('thirdPartyTokens', App\Http\Controllers\ThirdPartyTokensController::class);

Route::resource('billsExtensions', App\Http\Controllers\BillsExtensionController::class);

Route::get('/third_party_transactions/view-transactions/{date}/{co}', [App\Http\Controllers\ThirdPartyTransactionsController::class, 'viewTransactions'])->name('thirdPartyTransactions.view-transactions');
Route::resource('thirdPartyTransactions', App\Http\Controllers\ThirdPartyTransactionsController::class);

Route::get('/customers/get-dashboard-statistics', [App\Http\Controllers\CustomersController::class, 'getDashboardStatistics'])->name('customers.get-dashboard-statistics');
Route::get('/customers/trash', [App\Http\Controllers\CustomersController::class, 'trash'])->name('customers.trash');
Route::get('/customers/restore/{id}', [App\Http\Controllers\CustomersController::class, 'restore'])->name('customers.restore');
Route::get('/customers/double-entry-monitor', [App\Http\Controllers\CustomersController::class, 'doubleEntryMonitor'])->name('customers.double-entry-monitor');
Route::get('/customers/double-entry-view/{name}/{town}/{barangay}', [App\Http\Controllers\CustomersController::class, 'doubleEntryView'])->name('customers.double-entry-view');
Route::get('/customers/update-status', [App\Http\Controllers\CustomersController::class, 'updateStatus'])->name('customers.update-status');
Route::resource('customers', App\Http\Controllers\CustomersController::class);

Route::get('/customer_technicals/change-modem/{id}', [App\Http\Controllers\CustomerTechnicalController::class, 'changeModem'])->name('customerTechnicals.change-modem');
Route::resource('customerTechnicals', App\Http\Controllers\CustomerTechnicalController::class);

Route::resource('towns', App\Http\Controllers\TownsController::class);

Route::get('/barangays/get-barangays-json/{townId}', [App\Http\Controllers\BarangaysController::class, 'getBarangaysJSON'])->name('barangays.get-brgys-json');
Route::resource('barangays', App\Http\Controllers\BarangaysController::class);

Route::get('/billings/auto-generate-bills', [App\Http\Controllers\BillingsController::class, 'autoGenerateBills'])->name('billings.auto-generate-bills');
Route::get('/billings/auto-generate-bills-bulk', [App\Http\Controllers\BillingsController::class, 'autoGenerateBillsBulk'])->name('billings.auto-generate-bills-bulk');
Route::get('/billings/all-unpaid-bills', [App\Http\Controllers\BillingsController::class, 'allUnpaidBills'])->name('billings.all-unpaid-bills');
Route::get('/billings/generate-bill-due-notifs', [App\Http\Controllers\BillingsController::class, 'generateBillDueNotifs'])->name('billings.generate-bill-due-notifs');
Route::get('/billings/create-bill', [App\Http\Controllers\BillingsController::class, 'createBill'])->name('billings.create-bill');
Route::get('/billings/print-bill/{id}', [App\Http\Controllers\BillingsController::class, 'printBill'])->name('billings.print-bill');
Route::resource('billings', App\Http\Controllers\BillingsController::class);

Route::post('/payment_transactions/transact-bills-payment', [App\Http\Controllers\PaymentTransactionsController::class, 'transactBillsPayment'])->name('paymentTransactions.transact-bills-payment');
Route::get('/payment_transactions/monthly-sales', [App\Http\Controllers\PaymentTransactionsController::class, 'monthlySales'])->name('paymentTransactions.monthly-sales');
Route::get('/payment_transactions/dashboard-graph-data', [App\Http\Controllers\PaymentTransactionsController::class, 'dashboardGraphData'])->name('paymentTransactions.dashboard-graph-data');
Route::get('/payment_transactions/payments', [App\Http\Controllers\PaymentTransactionsController::class, 'payments'])->name('paymentTransactions.payments');
Route::get('/payment_transactions/payment-module/{id}', [App\Http\Controllers\PaymentTransactionsController::class, 'paymentModule'])->name('paymentTransactions.payment-module');
Route::get('/payment_transactions/transact-bill-bulk', [App\Http\Controllers\PaymentTransactionsController::class, 'transactBillsPaymentBulk'])->name('paymentTransactions.transact-bill-bulk');
Route::get('/payment_transactions/print-payment/{or}/{id}', [App\Http\Controllers\PaymentTransactionsController::class, 'printPayment'])->name('paymentTransactions.print-payment');
Route::resource('paymentTransactions', App\Http\Controllers\PaymentTransactionsController::class);

Route::get('/expenses/my-expenses', [App\Http\Controllers\ExpensesController::class, 'myExpenses'])->name('expenses.my-expenses');
Route::post('/expenses/store-ajax', [App\Http\Controllers\ExpensesController::class, 'storeAjax'])->name('expenses.store-ajax');
Route::get('/expenses/remove-my-expense/{id}', [App\Http\Controllers\ExpensesController::class, 'removeMyExpense'])->name('expenses.remove-my-expense');
Route::get('/expenses/balance-sheet', [App\Http\Controllers\ExpensesController::class, 'balanceSheet'])->name('expenses.balance-sheet');
Route::resource('expenses', App\Http\Controllers\ExpensesController::class);


Route::get('/stocks/add-stocks', [App\Http\Controllers\StocksController::class, 'addStocks'])->name('stocks.add-stocks');
Route::post('/stocks/store-ajax', [App\Http\Controllers\StocksController::class, 'storeAjax'])->name('stocks.store-ajax');
Route::resource('stocks', App\Http\Controllers\StocksController::class);

Route::resource('stockHistories', App\Http\Controllers\StockHistoryController::class);

Route::resource('ticketLogs', App\Http\Controllers\TicketLogsController::class);

Route::resource('ticketTypes', App\Http\Controllers\TicketTypesController::class);

Route::resource('tickets', App\Http\Controllers\TicketsController::class);

Route::resource('sMSNotifications', App\Http\Controllers\SMSNotificationsController::class);