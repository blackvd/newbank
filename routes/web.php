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

Route::get('/open-account', [App\Http\Controllers\OpenAccountController::class, 'index'])->name("new-account");
Route::post('/open-account', [App\Http\Controllers\OpenAccountController::class, 'openAccount'])->name("open-account");
Route::get('/open-account/success', [App\Http\Controllers\OpenAccountController::class, 'openAccountSuccess'])->name("open-account-success");

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.postLogin');

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/account_requests', [App\Http\Controllers\Admin\AccountRequestsController::class, 'index'])->name('admin.account_requests');
    Route::get('/account_requests/{trackId}', [App\Http\Controllers\Admin\AccountRequestsController::class, 'show'])->name('admin.account_requests.show');
    Route::post('/account_requests/{trackId}', [App\Http\Controllers\Admin\AccountRequestsController::class, 'changeStatus'])->name('admin.account_requests.change_status');
    Route::post('/account_requests/activate/{trackId}', [App\Http\Controllers\Admin\AccountRequestsController::class, 'activate'])->name('admin.account_requests.activate_account');
});

Route::post('/first-login', [App\Http\Controllers\Auth\LoginController::class, 'userFirstLogin'])->name('first_login');

//Route::get('/', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\User\AccountController::class, 'index'])->name('account');

Route::get('/order-card', [App\Http\Controllers\User\OrderCardController::class, 'index'])->name('order-card');
