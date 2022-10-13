<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

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

Route::get('/', [FrontController::class, 'home']);

Route::get('/t', function () {
    return view('test');
});

Route::get('/h', function () {
    return view('layout/front/home');
});

Route::get('/c', function () {
    return view('layout/front/category');
});

Route::get('/d', function () {
    return view('layout/front/homes');
});

