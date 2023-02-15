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
Route::get('products/{product}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.show');
Route::get('wizard/{product}', [App\Http\Controllers\WizardController::class, 'getStep1'])->name('wizard.show');
