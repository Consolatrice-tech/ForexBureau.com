<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExchangeController;
use App\Models\Payment;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/transactionOfPaypal', [PaymentController::class, 'indexOfPaypal']);
Route::get('/transactionOfOltranz', [PaymentController::class, 'indexOfOltranz']);
Route::post('/sendUsingOltranz', [PaymentController::class, 'oltranzTransaction'])->name('oltranzTransfer');
Route::get('redirects', [AuthController::class, 'redirects']);
Route::post('/register', [AuthController::class, 'register'])->name('registration');
Route::post('/login', [AuthController::class, 'login'])->name('authentication');
Route::get('/exchangePage', [ExchangeController::class, 'getExpensePage'])->name('exchangePage');
Route::post('/exchangePage', [ExchangeController::class, 'exchange'])->name('postExchange');
Route::get('MyTransactions', [PaymentController::class, 'MyTransactions'])->name('MyTransactions');
Route::get('status', [ExchangeController::class, 'getPaymentStatus'])->name('status');

//Administration

Route::get('AdministrationPanel', [AdminController::class, 'index'])->name('AdministrationPanel');
