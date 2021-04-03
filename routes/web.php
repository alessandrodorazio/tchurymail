<?php

use App\Models\Email;
use App\Models\Template;
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
Route::get('/auth/forgot-password', [
    \App\Http\Controllers\RecoverPasswordController::class,
    'requestPassword',
])->middleware('guest')->name('password.request');

Route::post('/auth/forgot-password', [
    \App\Http\Controllers\RecoverPasswordController::class,
    'sendEmailRequestPassword',
])->middleware('guest')->name('password.email');
Route::get('/auth/reset-password/{token}', [
    \App\Http\Controllers\RecoverPasswordController::class,
    'resetPassword',
])->middleware('guest')->name('password.reset');

Route::post('/auth/reset-password', [
    \App\Http\Controllers\RecoverPasswordController::class,
    'updatePassword',
])->middleware('guest')->name('password.update');

Route::get('/preview/{uuid}', function($uuid) {
    $email = new Email;
    $template = Template::where('secret_api', $uuid)->first();
    $email->template_id = $template->id;
    $content = $email->constructEmailContent((object)[], ['preview' => true]);

    return view('mail_preview', compact('content'));
})->name('mail_preview');


