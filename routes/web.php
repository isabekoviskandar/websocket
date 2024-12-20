<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/message' , [MessageController::class, 'index']);
Route::post('/message_store' , [MessageController::class, 'store']);
