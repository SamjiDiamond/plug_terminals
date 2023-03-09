<?php


use App\Http\Controllers\Service\FTController;
use App\Http\Controllers\Service\TerminalController;
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

Route::prefix('service/ft')->middleware('service-auth')->group(function () {
    Route::get('banks',  [FTController::class, 'banks']);
    Route::post('bank-validate',  [FTController::class, 'verify']);
    Route::post('transfer',  [FTController::class, 'transfer']);
    Route::post('tsq',  [FTController::class, 'tsq']);
});


Route::prefix('service/terminal')->middleware('secret-auth')->group(function () {
    Route::get('list',  [TerminalController::class, 'terminals']);
    Route::get('terminal-serial/{serial}',  [TerminalController::class, 'terminalwserial']);
    Route::get('transactions/{id}',  [TerminalController::class, 'terminalTransactions']);
});

