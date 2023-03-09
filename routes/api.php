<?php

use App\Http\Controllers\Service\FTController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WemaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('VFDAuth')->post('/webhook/vfd', [\App\Http\Controllers\VFDWebhookController::class, 'index']);

Route::middleware('wema-auth')->group(function () {
    Route::post('webhook/wema-vnuban',  [WebhookController::class, 'wemaWebhook']);

    Route::post('wema/accountLookup',  [WemaController::class, 'accountLookup']);
});


Route::post('hook/grupp-card-transaction',  [\App\Http\Controllers\WebhookGruppController::class, 'index']);

require __DIR__.'/app.php';
require __DIR__.'/service.php';
