<?php

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

Route::get('/admin/registration/start',[App\Http\Controllers\UserController::class,'getAdminRegister'])->name('admin.start.register');
Route::post('/admin/registration/post/start',[App\Http\Controllers\UserController::class,'store'])->name('admin.store.register');
Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['register' => false]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
