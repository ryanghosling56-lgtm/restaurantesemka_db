<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//cek database
Route::get('/cekdatabase', [App\Http\Controllers\cekcontroller::class, 'index']);
//api login flutter
Route::post('/login', [AuthController::class, 'login']);
