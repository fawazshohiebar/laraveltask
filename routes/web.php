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

Route::get('/Registration', function () {
    return view('Registration');
});
Route::get('/Login', function () {
    return view('Login');
});
Route::get('/UserPage', function () {
    return view('UserPage');
});
Route::get('/AdminPage', function () {
    return view('AdminPage');
});