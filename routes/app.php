<?php

use App\Http\Controllers\Mobile\NibssPayController;
use App\Http\Controllers\Mobile\AuthenticationController;
use App\Http\Controllers\Mobile\BillsPaymentController;
use App\Http\Controllers\Mobile\BusinessController;
use App\Http\Controllers\Mobile\PayoutController;
use App\Http\Controllers\Mobile\TerminalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'app'], function () {

    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('reset-password', [AuthenticationController::class, 'resetPassword']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('transactions', [BusinessController::class, 'transactions']);
        Route::get('wallets', [BusinessController::class, 'wallets']);

        Route::get('terminals', [TerminalController::class, 'terminalList']);
        Route::get('terminals/transaction/{id}', [TerminalController::class, 'terminalTransactions']);

        Route::get('airtime-providers', [BillsPaymentController::class, 'airtimeProviders']);
        Route::get('internet-providers', [BillsPaymentController::class, 'internetProviders']);
        Route::get('internet-plans/{provider}', [BillsPaymentController::class, 'internetDataPlan']);
        Route::get('cabletv-providers', [BillsPaymentController::class, 'cabletvProviders']);
        Route::get('cabletv-plans/{provider}', [BillsPaymentController::class, 'tvPackages']);
        Route::get('electricity-providers', [BillsPaymentController::class, 'electricityProviders']);

        Route::post('setpin', [AuthenticationController::class, 'setPin']);

        Route::post('buy-airtime', [BillsPaymentController::class, 'airtimeTopup']);
        Route::post('buy-data', [BillsPaymentController::class, 'internetData']);
        Route::post('cabletv-validate', [BillsPaymentController::class, 'tvValidate']);
        Route::post('cabletv-pay', [BillsPaymentController::class, 'payTv']);
        Route::post('electricity-validate', [BillsPaymentController::class, 'electricityValidate']);
        Route::post('electricity-pay', [BillsPaymentController::class, 'electricityRecharge']);

        Route::get('bank-list', [NibssPayController::class, 'bankList']);
        Route::post('bank-validate', [NibssPayController::class, 'verify']);
        Route::post('bank-transferfee', [PayoutController::class, 'transferFee']);
        Route::post('bank-transfer', [NibssPayController::class, 'transfer']);

        Route::get('profile', [BusinessController::class, 'profile']);
        Route::post('update-password', [BusinessController::class, 'updatePassword']);

    });

});
