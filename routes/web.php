<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PretController;
use App\Http\Controllers\OpenAccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\DemandeController;
use App\Http\Controllers\User\OrderCardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AccountRequestsController;
use App\Http\Controllers\Admin\AccountManagmentController;
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

Route::get('/open-account', [OpenAccountController::class, 'index'])->name("new-account");
Route::post('/open-account', [OpenAccountController::class, 'openAccount'])->name("open-account");
Route::get('/open-account/success', [OpenAccountController::class, 'openAccountSuccess'])->name("open-account-success");

Auth::routes();

Route::post('/first-login', [App\Http\Controllers\Auth\LoginController::class, 'userFirstLogin'])->name('first_login');

//Route::get('/', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('home');
Route::get('/', [AccountController::class, 'index'])->name('account');

Route::get('/order-card', [OrderCardController::class, 'index'])->name('order-card');
Route::post('/order-card', [OrderCardController::class, 'orderCard'])->name('submit_order');
Route::get('/card', [OrderCardController::class, 'cards'])->name('cards');
Route::post('/block-card', [OrderCardController::class, 'bloquer'])->name('block_card');

Route::post('/pret', [PretController::class, 'askPret'])->name('pret.ask');

// transactions des compte
Route::post('/transaction/inte', [TransactionController::class, "storeInt"])->name('trans_inter_compte');
Route::post('/transaction/ext', [TransactionController::class, "storeExt"])->name('trans_ext_compte');

// Demande du rib

Route::post('/demande/rib', [DemandeController::class, "rib"])->name('demande_rib');

Route::post('/demande/relever', [DemandeController::class, "relever"])->name('demande_relever');


Route::group(['prefix' => "admin"], function () {
    Route::get('/login', [AdminLoginController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'adminLogin'])->name('admin.postLogin');
    Route::post('/logout', [AdminLoginController::class, 'adminLogout'])->name('admin.postLogout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Demande de pret 
    Route::get('/pret', [PretController::class, "index"])->name('pret.index');
    Route::get('/pret/{id}', [PretController::class, "show"])->name('pret.show');
    Route::get('/pret/reject/{id}', [PretController::class, "reject"])->name('pret.reject');
    Route::post('/pret/eligibilite/{id}', [PretController::class, "eligibilite"])->name('pret.eligibilite');
    Route::post('/pret/accorder/{id}', [PretController::class, "accorder"])->name('pret.accorder');

    // Fin de demande de pret

    Route::get('/account_requests', [AccountRequestsController::class, 'index'])->name('admin.account_requests');
    Route::get('/account_requests/{trackId}', [AccountRequestsController::class, 'show'])->name('admin.account_requests.show');
    Route::post('/account_requests/{trackId}', [AccountRequestsController::class, 'changeStatus'])->name('admin.account_requests.change_status');
    Route::post('/account_requests/activate/{trackId}', [AccountRequestsController::class, 'activate'])->name('admin.account_requests.activate_account');
    Route::get('/account_requests/block/{trackId}', [AccountRequestsController::class, 'block'])->name('admin.account_requests.block_account');

    Route::get('/account_managments', [AccountManagmentController::class, 'index'])->name('admin.account_managements');
});
