<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return redirect('https://aicoders.in/');
});

Route::resource('contacts', ContactController::class);