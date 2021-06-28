<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
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
//clients api routes

Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);


//invoices api routes

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::post('/invoices', [InvoiceController::class, 'store']);
Route::delete('/invoices/{id}', [ClientController::class, 'destroy']);




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
