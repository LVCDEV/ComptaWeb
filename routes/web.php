<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AccountTypeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/app')->controller(AppController::class)->name('app.')->group(function () {
    Route::resource('/', AppController::class)->only(['index']);
    Route::resource('/accounts', AccountController::class);
    Route::resource('/transactions', TransactionController::class)->except(['show']);
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('/users', UserController::class)->except(['show']);
    Route::resource('/banks', BankController::class)->except(['show']);
    Route::resource('/accounttypes', AccountTypeController::class)->except(['show']);
});
