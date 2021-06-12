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
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
