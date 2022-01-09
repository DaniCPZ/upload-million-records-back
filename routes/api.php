<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RandomDataController;

Route::get('/upload', [RandomDataController::class, 'index']);

Route::post('/upload', [RandomDataController::class, 'upload']);

Route::get('/batch', [RandomDataController::class, 'batch']);

Route::get('/batch/in-progress', [SalesController::class, 'batchInProgress']);