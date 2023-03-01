<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('callback/{provider}', [App\Http\Controllers\CallbackController::class, 'index'])->name('callback');
Route::get('callback/{provider}', [App\Http\Controllers\CallbackController::class, 'error'])->name('callback');
