<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/', function () {
    return view('welcome');
});

//invoices routes
Route::get('/invoices',[InvoiceController::class,'show']);
Route::get('/invoices',[InvoiceController::class,'sendInvoice'])->name('invoices');


//clients routes
Route::get('/clients',[ClientController::class,'show']);
Route::get('/clients',[ClientController::class,'sendClient'])->name('clients');
