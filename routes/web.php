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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
Route::get('wallet_connect/{wallet}/{bech32}', [App\Http\Controllers\HomeController::class, 'connectWallet'])->name('connectWallet');
Route::get('wallet_disconnect', [App\Http\Controllers\HomeController::class, 'disconnectWallet'])->name('disconnectWallet');
Route::get('products/{product}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.show');
Route::get('products/faq/{product}', [App\Http\Controllers\ProductController::class, 'faq'])->name('product.faq');
Route::get('wizard/{product}', [App\Http\Controllers\WizardController::class, 'getStep1'])->name('wizard.getStep1');
Route::post('wizard/{product}', [App\Http\Controllers\WizardController::class, 'getStep2'])->name('wizard.getStep2');
Route::get('wizard/{product}/{UUID}', [App\Http\Controllers\WizardController::class, 'getStep3'])->name('wizard.getStep3');
Route::post('checkIncomingPayment', [App\Http\Controllers\WizardController::class, 'checkIncomingPayment'])->name('checkIncomingPayment');
Route::get('finish/{UUID}', [App\Http\Controllers\ThankYouController::class, 'index'])->name('thankyou');
Route::get('didverification/', [App\Http\Controllers\DIDVerificationController::class, 'index']);
Route::post('didverification/', [App\Http\Controllers\DIDVerificationController::class, 'create']);
