<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AccountTypeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\TestController;
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

Route::prefix('/app')->name('app.')->middleware(['auth'])->group(function () {
    Route::get('/', [AppController::class, 'index'])->name('index');
    Route::post('search_account', [AppController::class, 'search_account'])->name('search_account');
    Route::post('search_transaction', [AppController::class, 'search_transaction'])->name('search_transaction');
    Route::resource('/accounts', AccountController::class);
    Route::resource('/transactions', TransactionController::class)->except(['show']);
});

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin');
    Route::delete('/logout', 'logout')->name('logout');
});

Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('/users', UserController::class)->except(['show']);
    Route::resource('/banks', BankController::class)->except(['show']);
    Route::resource('/accounttypes', AccountTypeController::class)->except(['show']);
});

Route::prefix('/app/transactions')->controller(TransactionController::class)->name('app.transactions.')->middleware(['auth'])->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('index');
    Route::get('/create', [TransactionController::class, 'create'])->name('create');
    Route::get('/create/transfert', [TransactionController::class, 'create_transfert'])->name('create_transfert');
    Route::post('/', [TransactionController::class, 'store'])->name('store');
    Route::post('/transfert', [TransactionController::class, 'store_transfert'])->name('store_transfert');
    Route::get('/{transaction}/edit', [TransactionController::class, 'edit'])->name('edit');
    Route::patch('/{transaction}', [TransactionController::class, 'update'])->name('update');
    Route::delete('/{transaction}', [TransactionController::class, 'destroy'])->name('destroy');
    Route::post('/search', [TransactionController::class, 'search'])->name('search');
});
