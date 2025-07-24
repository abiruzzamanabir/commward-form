<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NominationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\ThemeController;

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

Route::resource('/form', NominationController::class);
Route::resource('/theme', ThemeController::class);
Route::get('/special-form', [NominationController::class, 'special'])->name('form.special');
Route::get('/', [NominationController::class, 'redirect'])->name('form.redirect');
Route::get('/form/hosted/{ukey?}', [NominationController::class, 'hosted'])->name('form.hosted');
Route::get('/student/', [NominationController::class, 'student'])->name('form.student');
Route::post('/form/updateinfo/{id}', [NominationController::class, 'updateinfo'])->name('form.updateinfo');
Route::get('/thank-you/{ukey?}', [NominationController::class, 'thanks'])->name('form.thank');
Route::get('/thanks/{ukey?}', [NominationController::class, 'free'])->name('form.thank.free');
Route::resource('/dashboard', DashboardController::class);
Route::post('/dashboard/payment', [DashboardController::class, 'makePayment'])->name('dashboard.payment');
Route::post('/dashboard/payment/confirm', [DashboardController::class, 'paymentConfirmation'])->name('dashboard.payment.confirm');
Route::get('/trash', [DashboardController::class, 'trash'])->name('trash.index');
Route::get('/payment-verified', [DashboardController::class, 'pv'])->name('paymentverified.index');
Route::get('/status-update/{id}', [DashboardController::class, 'updateStatus'])->name('status.update');
Route::get('/payment-status-update/{id}', [DashboardController::class, 'updatePV'])->name('payment.status.update');
Route::get('/trash-update/{id}', [DashboardController::class, 'updateTrash'])->name('trash.update');
Route::get('/comment-empty/{id}', [DashboardController::class, 'commentEmpty'])->name('comment.empty');
Route::resource('/invoice', InvoiceController::class);
Route::get('/invoice-form', [InvoiceController::class,'form'])->name('invoice.form');
Route::post('/authenticate-theme', [ThemeController::class, 'authenticateTheme'])->name('authenticate.theme');
Route::post('/authenticate-time', [ThemeController::class, 'authenticateTime'])->name('authenticate.time');
Route::get('/time', [ThemeController::class, 'time'])->name('theme.time');

// SSLCOMMERZ Start
Route::get('/easycheckout', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/hostedcheckout', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::get('/nomination-export', [NominationController::class, 'allExport'])->name('all.export');
