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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/t', function () {
    return view('test');
});
Route::get('transaction-medias','App\Http\Controllers\TransactionController@get_transaction_media'); 
Route::resource('transactions','App\Http\Controllers\TransactionController');

// Route::get('/user', [UserController::class, 'index']);


