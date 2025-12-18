<?php

use Illuminate\Support\Facades\Route;

// Catch-all route pour SPA React
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
