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

Route::post('client/login',[App\Http\Controllers\ApiController::class,'clientLogin'])->name('api.clients.login');
Route::post('client/register',[App\Http\Controllers\ApiController::class,'clientRegister'])->name('api.clients.register');
Route::post('client/getTransaction',[App\Http\Controllers\ApiController::class,'clientGetTransaction'])->name('api.clients.clientGetTransaction');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
