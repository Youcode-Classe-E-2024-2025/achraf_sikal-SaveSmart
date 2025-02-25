<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', [UserController::class,'profile']);
Route::get('/signup', [UserController::class,'signup']);
Route::get('/login', [UserController::class,'login']);
Route::post('/signup', [UserController::class,'signup']);
Route::post('/logout', [UserController::class,'logout']);
Route::post('/login', [UserController::class,'login']);
