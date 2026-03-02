<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cekdatabase', [App\Http\Controllers\cekcontroller::class, 'index']);

