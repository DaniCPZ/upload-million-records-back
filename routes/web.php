<?php

use App\Http\Controllers\RandomDataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [RandomDataController::class, 'index']);

Route::post('/upload', [RandomDataController::class, 'upload']);

Route::get('/store-data', [RandomDataController::class, 'store']);