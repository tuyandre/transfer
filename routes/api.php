<?php

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

Route::post('/client/login',[App\Http\Controllers\ApiController::class,'clientLogin'])->name('api.clients.login');
Route::post('/client/register',[App\Http\Controllers\ApiController::class,'clientRegister'])->name('api.clients.register');
Route::post('/client/getTransaction',[App\Http\Controllers\ApiController::class,'clientGetTransaction'])->name('api.clients.clientGetTransaction');
Route::post('/client/getClientTransaction',[App\Http\Controllers\ApiController::class,'getClientTransaction'])->name('api.clients.getClientTransaction');
Route::post('/client/getClientBalance',[App\Http\Controllers\ApiController::class,'getClientBalance'])->name('api.clients.getClientBalance');
Route::post('/client/clientTransferMoney',[App\Http\Controllers\ApiController::class,'clientTransferMoney'])->name('api.clients.clientTransferMoney');
Route::post('/client/clientWithdrawMoney',[App\Http\Controllers\ApiController::class,'clientWithdraw'])->name('api.clients.clientWithdrawMoney');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
