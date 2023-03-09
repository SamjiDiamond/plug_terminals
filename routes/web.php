<?php

use App\Http\Controllers\Client\AdminController;
use App\Http\Controllers\Client\IncomeController;
use App\Http\Controllers\Client\NibssPayController;
use App\Http\Controllers\Client\ServicesController;
use App\Http\Controllers\Client\SettingsController;
use App\Http\Controllers\Client\BillsproductController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BillsPaymentController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\AgentTransferController;
use App\Http\Controllers\Client\CustomerController;
use App\Http\Controllers\Client\DisbursementController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\TerminalController;
use App\Http\Controllers\Client\TransactionsController;
use App\Http\Controllers\Client\TransferController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PosManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VFDController;
use App\Http\Controllers\WalletController;
use App\Jobs\AgencyBillsPaymentSetupJob;
use Illuminate\Support\Facades\Route;

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

//Route::get('/bankList', [\App\Http\Controllers\VFDController::class, 'bankList'])->name('bankList');
//
//Route::get('/testgterminal', [\App\Http\Controllers\GruppTerminalController::class, 'sessionid'])->name('sessionid');
//Route::get('grupp-transactions', [\App\Http\Controllers\GruppTerminalController::class, 'transaction'])->name('admin.grupp.terminal');

Route::get('/', function () {
//    return view('welcome');
    return redirect()->route('login');
});

Route::get('/testwelcome', function () {
 return (new \App\Mail\AssignTerminalMail())->render();
});

Route::get('/testagency/{id}', function ($id) {
    AgencyBillsPaymentSetupJob::dispatch($id);
    return "done";
});

Route::get('/ttt', function () {

    AgencyBillsPaymentSetupJob::dispatch(1);

    return "i am done";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.alternative.me/v2/listings/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);


$resp=json_decode($response, true);

dd($resp['data']);


});

Route::get('/kyc/{filename}', function ($filename) {
    $path = storage_path('app/public/kyc/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('show.kyc');

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('login')->with('success', 'Account logout successfully');
})->name('logout');

Route::middleware(['auth:sanctum', 'verified', 'AdminCheck'])->group(function () {

    Route::get('/dashboard', [IndexController::class, 'dashboard_home'])->name('dashboard');
    Route::get('/transactions', [TransactionsController::class, 'transactions'])->name('transactions');
    Route::get('/customers', [CustomerController::class, 'customer'])->name('customers');

    Route::get('/terminals', [TerminalController::class, 'terminals'])->name('terminals');
    Route::get('/revoke-terminal/{id}', [TerminalController::class, 'revokeTerminal'])->name('terminal.revoke');
    Route::get('/terminal-transaction/{id}', [TerminalController::class, 'terminalTransactions'])->name('terminal.transaction');

    Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
    Route::get('/admin/ed/{id}', [AdminController::class, 'edAdmin'])->name('edAdmin');
    Route::get('/admin/resetpassword/{id}', [AdminController::class, 'resetPassword'])->name('adminResetpassword');
    Route::get('/admin/delete/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');
    Route::post('/create-admin', [AdminController::class, 'createAdmin'])->name('createAdmin');

    Route::get('/create-agent', [CustomerController::class, 'createAgent'])->name('createAgent');
    Route::get('/accounts', [AccountController::class, 'account'])->name('account');
    Route::get('settings', [SettingsController::class, 'settings'])->name('settings');
    Route::get('generate-api-key', [SettingsController::class, 'apiKey'])->name('generate-api-key');
    Route::post('/agent-trans', [AgentTransferController::class, 'agenttrans'])->name('agent-trans');
    Route::get('/agent-transfer', [AgentTransferController::class, 'fectchagent'])->name('agent-transfer');
    Route::get('/transfer', [NibssPayController::class, 'index'])->name('transfer');
    Route::post('/verify', [NibssPayController::class, 'verify'])->name('verify');
    Route::post('/requesttransfer', [NibssPayController::class, 'transfer'])->name('requesttransfer');
    Route::get('/tsq_transfer/{ref}', [NibssPayController::class, 'tsq'])->name('tsq_transfer');
    Route::get('/nibssBalance', [NibssPayController::class, 'balanceenquiry'])->name('balanceenquiry');

    Route::get('/internetdata', [BillsproductController::class, 'index'])->name('internetdata');
    Route::get('/tv', [BillsproductController::class, 'index1'])->name('tv');
    Route::get('/electricity', [BillsproductController::class, 'electricity'])->name('electricity');
    Route::get('/airtime', [BillsproductController::class, 'airtime'])->name('airtime');

    Route::get('/airtime/modify/{id}', [BillsproductController::class, 'airtimeModify'])->name('airtimeModify');
    Route::get('/electricity/modify/{id}', [BillsproductController::class, 'electricityModify'])->name('electricityModify');
    Route::get('/data/modify/{id}', [BillsproductController::class, 'dataModify'])->name('dataModify');
    Route::get('/tv/modify/{id}', [BillsproductController::class, 'tvModify'])->name('tvModify');

    Route::get('/editAirtime/{id}', [BillsproductController::class, 'editAirtime'])->name('editAirtime');
    Route::get('/editElectricity/{id}', [BillsproductController::class, 'editElectricity'])->name('editElectricity');
    Route::get('/editData/{id}', [BillsproductController::class, 'editData'])->name('editData');
    Route::get('/editTV/{id}', [BillsproductController::class, 'editTV'])->name('editTV');

    Route::post('/airtimeUpdate', [BillsproductController::class, 'airtimeUpdate'])->name('airtimeUpdate');
    Route::post('/electricityUpdate', [BillsproductController::class, 'electricityUpdate'])->name('electricityUpdate');
    Route::post('/done', [BillsproductController::class, 'done'])->name('done');
    Route::post('/done1', [BillsproductController::class, 'done1'])->name('done1');

    Route::get('/disbursement', [DisbursementController::class, 'disbursement'])->name('disbursement');

    Route::get('/map-terminal', [TerminalController::class, 'map_terminal'])->name('map_terminal');
    Route::post('/map-terminal', [TerminalController::class, 'map_terminal_post'])->name('map_terminal_post');

    Route::get('/services', [ServicesController::class, 'listServices'])->name('services');
    Route::post('/updateFee', [ServicesController::class, 'updateFee'])->name('updateFee');

    Route::get('/income', [IncomeController::class, 'income'])->name('income');

//    Route::post('vpay', [VFDController::class, 'accountTransfer'])->name('vpay');
//
//    Route::post('pay', [VFDController::class, 'accountTransfer12'])->name('pay');
//
//    Route::get('add-sub-agent', function () {
//        return view('add-agent');
//    })->name('addSubAgent');
//
    Route::post('/create-sub-agent', [AgentController::class, 'createSubAgent'])->name('createSubAgent');
//
//    Route::get('/agents', [AgentController::class, 'subAgents'])->name('agents');
//
//    Route::post('/agents', [AgentController::class, 'searchSubAgents'])->name('searchSubAgents');
//
//    Route::get('/float', [AgentController::class, 'float'])->name('float');
//    Route::get('/float/loangit', [AgentController::class, 'float'])->name('floatloan');
//
//    Route::post('/float', [AgentController::class, 'floatpost'])->name('floatrequest');
//
//    Route::get('add-customer', function () {
//        return view('add-user');
//    })->name('add-customer');
//
//    Route::get('add-customer-otp', function () {
//        return view('add-user-otp');
//    })->name('addCustomerOTP');
//
//    Route::get('/customers', [CustomersController::class, 'fetchCustomers'])->name('customers');
//    Route::post('/create-customer', [CustomersController::class, 'createCustomer'])->name('createCustomer');
//    Route::post('/create-customer-otp', [CustomersController::class, 'createCustomerOtp'])->name('createCustomerOTP');
//
//    Route::get('/debit-card', [CustomersController::class, 'fetchDebitcard'])->name('debit-card');
//
//    Route::get('debit-card-otp', function () {
//        return view('debit-card-otp');
//    })->name('debit-card-OTP');
//
//    Route::post('/debit-card-verify', [CustomersController::class, 'verifyDebitcard'])->name('verifyDebitcard');
//    Route::post('/debit-card-proceed', [CustomersController::class, 'debitCardProceed'])->name('debit-card-proceed');
//
//
//    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
//
//    Route::get('/terminals', [PosManagementController::class, 'terminals'])->name('terminals');
//    Route::post('/terminals', [PosManagementController::class, 'assignterminals']);
//    Route::get('/transactions/{id}/subagent', [AgentController::class, 'agentTransactions'])->name('agentTransactions');
//    Route::get('/wallet/history', [WalletController::class, 'history'])->name('walletHistory');
//    Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('walletWithdraw');
//
//
//    Route::get('/profile', function () {
//        return view('settings/pro');
//    })->name('profile');
//
//    Route::get('/settings', function () {
//        return view('profile');
//    })->name('settings');
//
//
//    Route::get('settings/performance', [AgentController::class, 'performance'])->name('agent.performance');
//    Route::post('settings/performance', [AgentController::class, 'performanceSearch'])->name('agent.performanceSearch');
//
//    Route::get('/posmanagement', function () {
//        return view('posmanagement');
//    });
//
//    Route::get('/bill-payment', function (){
//        return view('bill-payment');
//    });
//
//
//
//
//    Route::get('transfer', [VFDController::class, 'bankList'])->name('transfer');
//
//
//    Route::get('/bills/airtime', function () {
//        return view('bills/airtime');
//    })->name('bills.airtime');
//    Route::post('buyAirtime', [BillsPaymentController::class, 'buyAirtime'])->name('buyAirtime');
//
//    Route::get('bills/data', [BillsPaymentController::class, 'data'])->name('bills.data');
//    Route::post('bills/dataplans', [BillsPaymentController::class, 'dataPlans'])->name('bills.dataplans');
//    Route::post('bills/buydata', [BillsPaymentController::class, 'buyDataPlans'])->name('bills.buydata');
//
//    Route::get('/bills/tv', function () {
//        return view('bills/tv');
//    })->name('bills.tv');
//    Route::post('bills/list', [BillsPaymentController::class, 'TVPlans'])->name('bills.list');
//    Route::get('bills/renewtv', [BillsPaymentController::class, 'renewTV'])->name('bills.renewtv');
//    Route::post('bills/tvlist', [BillsPaymentController::class, 'validateTV'])->name('bills.tvlist');
//    Route::post('bills/changeTVSub', [BillsPaymentController::class, 'changeTVSub'])->name('bills.changeTVSub');
//
//    Route::get('bills/elect', [BillsPaymentController::class, 'electricityList'])->name('bills.elect');
//    Route::post('biils/verifyelect', [BillsPaymentController::class, 'validateElectricity'])->name('bills.verifyelect');
//    Route::post('bills/pay', [BillsPaymentController::class, 'purchaseElectricity'])->name('bills.pay');
//
//    Route::post('verify', [VFDController::class, 'validateBankAccount'])->name('verify');
//
//
//    Route::get('/wallet/transfer', function () {
//        return view('wallet_transfer');
//    })->name('walletTransfer');
//
//    Route::get('/bills/receipt', function () {
//        return view('bills/receipt');
//    });
//
//    Route::get('/settings/preferences', function () {
//        return view('settings/preferences');
//    });
//
//    Route::get('/settings/noti', function () {
//        return view('settings/noti');
//    });
//    Route::get('/settings/pass', function () {
//        return view('settings/pass');
//    });
//    Route::get('/settings/delete', function (){
//        return view('settings/delete');
//    });
//    Route::post('bills.bill', [BillsPaymentController::class, 'buyAirtime'])->name('bills.bill');

});

require __DIR__ . '/admin.php';
