<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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
Route::prefix('/Administration/')->group(
    function () {
        Route::get('users/all',[App\Http\Controllers\UserController::class,'userPages'])->name('admin.users.all');
        Route::get('users/getAllUsers',[App\Http\Controllers\UserController::class,'getAllUsers'])->name('admin.users.getAllUsers');
        Route::get('users/customerDetail/{id}',[App\Http\Controllers\UserController::class,'customerDetail'])->name('admin.users.customerDetail');
        Route::get('users/getCustomerDetail/{id}',[App\Http\Controllers\UserController::class,'getCustomerDetail'])->name('admin.users.getCustomerDetail');
        Route::post('users/storeAgents',[App\Http\Controllers\UserController::class,'storeUser'])->name('admin.users.storeUser');


        Route::get('users/allAgent',[App\Http\Controllers\UserController::class,'allAgentPage'])->name('admin.users.allAgents');
        Route::get('users/getAllAgent',[App\Http\Controllers\UserController::class,'getAllAgent'])->name('admin.users.getAllAgents');

        Route::get('users/allCustomer',[App\Http\Controllers\UserController::class,'allCustomerPages'])->name('admin.users.allCustomers');
        Route::get('users/getAllCustomer',[App\Http\Controllers\UserController::class,'getAllCustomer'])->name('admin.users.getAllCustomer');

        Route::get('transactions/customers',[App\Http\Controllers\TransactionController::class,'index'])->name('admin.transactions.index');
        Route::get('transactions/getCustomerTransaction',[App\Http\Controllers\TransactionController::class,'getClientTransaction'])->name('admin.transactions.getClientTransaction');
        Route::post('transactions/agentDeposit',[App\Http\Controllers\TransactionController::class,'agentDeposit'])->name('admin.transactions.agentDeposit');

        Route::get('transactions/compte',[App\Http\Controllers\TransactionController::class,'company_compte'])->name('admin.transactions.company_compte');
        Route::get('transactions/getCompteTransaction',[App\Http\Controllers\TransactionController::class,'getCompanyTransaction'])->name('admin.transactions.getCompanyTransaction');

    });

    Route::prefix('/Agent/')->group(
    function () {
        Route::get('clients/saving',[App\Http\Controllers\AgentController::class,'clientSaving'])->name('agent.clients.clientSaving');
        Route::get('clients/getClientSaving',[App\Http\Controllers\AgentController::class,'getClientSaving'])->name('agent.clients.getClientSaving');
        Route::post('clients/saveClientSaving',[App\Http\Controllers\AgentController::class,'saveClientSaving'])->name('agent.clients.saveClientSaving');






        Route::get('clients/withdraw',[App\Http\Controllers\AgentController::class,'clientWithdraw'])->name('agent.clients.clientWithdraw');
        Route::get('clients/getClientWithdraw',[App\Http\Controllers\AgentController::class,'getClientWithdraw'])->name('agent.clients.getClientWithdraw');

        Route::get('clients/transactions',[App\Http\Controllers\AgentController::class,'clientTransaction'])->name('agent.clients.clientTransaction');
        Route::get('clients/getClientTransaction',[App\Http\Controllers\AgentController::class,'getClientTransaction'])->name('agent.clients.getClientTransaction');

        Route::get('auth/tasks',[App\Http\Controllers\AgentController::class,'agentTransaction'])->name('agent.auth.agentTransaction');
        Route::get('auth/getMyTransaction',[App\Http\Controllers\AgentController::class,'getMyTransaction'])->name('agent.auth.getMyTransaction');

    });
