<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProfilesController;

Route::get('/', function () {
    return view('welcome');
});



Route::post('/family/join', [FamilyController::class, 'join'])->name('family.join');
Route::post('/family/create', [FamilyController::class, 'create'])->name('family.create');
Route::get('/family', function () {
    return view('family/join');
});

Route::get('/profile', [UserController::class,'profile']);
Route::get('/signup', [UserController::class,'signup']);
Route::get('/login', [UserController::class,'login']);
Route::post('/signup', [UserController::class,'signup']);
Route::post('/logout', [UserController::class,'logout']);
Route::post('/login', [UserController::class,'login']);

Route::resource('profile', ProfilesController::class);
