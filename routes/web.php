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

Route::get ('/{uuid}', function ($uuid) {
    $email = new Email;
    $template = Template::where ('secret_api', $uuid)->first ();
    $email->template_id = $template->id;
    $content = $email->constructEmailContent ((object)[]);

    return view ('mail_preview', compact ('content'));
})->name ('mail_preview');


