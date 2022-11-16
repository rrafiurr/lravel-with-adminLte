<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();
// if(Auth::check()){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/t', function () {
        return view('test');
    });
    Route::get('transaction-medias','App\Http\Controllers\TransactionController@get_transaction_media'); 
    Route::get('transaction-list','App\Http\Controllers\TransactionController@list'); 
    Route::resource('transactions','App\Http\Controllers\TransactionController');

    Route::get('donation-view','App\Http\Controllers\WeekController@index');
    Route::get('donation-report','App\Http\Controllers\WeekController@report'); 
    


    //user
    Route::resource('users','App\Http\Controllers\UserController');
    // Route::get('/user', [UserController::class, 'index']);


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// }
// else{
//     return redirect('/login');
// }