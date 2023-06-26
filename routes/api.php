<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserssController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\UserCertificateController;
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



Route::post('/Userr/post', [UserssController::class, 'store']);

Route::put('/User/put/{id}', [UserssController::class, 'update']);

Route::delete('/User/delete/{id}', [UserssController::class, 'destroy']);
Route::get('/User/read', [UserssController::class, 'index']);
Route::post('/User/checker', [UserssController::class, 'checking']);
Route::put('/User/isapproved/{id}', [UserssController::class, 'edit']);
Route::get('/User/read/{id}', [UserssController::class, 'show']);




Route::post('/Cerificate/post', [CertificatesController::class, 'store']);
Route::delete('/Cerificate/delete/{id}', [CertificatesController::class, 'destroy']);
Route::get('/Cerificate/read', [CertificatesController::class, 'index']);



Route::post('/userCertificate/post', [UserCertificateController::class, 'store']);
Route::get('/userCertificate/read/{userId}', [UserCertificateController::class, 'show']);
Route::delete('/userCertificate/delete/{id}', [UserCertificateController::class, 'destroy']);
Route::get('/userCertificate/read', [UserCertificateController::class, 'index']);
