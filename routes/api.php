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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', '\App\Http\Controllers\AuthController@login')->name('login');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/sendEmail/{uuid}', '\App\Http\Controllers\EmailController@sendEmail');
});
Route::post('/emails/send/{uuid}', '\App\Http\Controllers\EmailController@sendEmail');
