<?php

use App\Http\Controllers\BudgetOptController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});



Route::post('/family/join', [FamilyController::class, 'join'])->name('family.join');
Route::post('/family/create', [FamilyController::class, 'create'])->name('family.create');
Route::get('/family', function () {
    return view('family/join');
});

Route::get('/dash', [UserController::class,'profile']);
Route::get('/signup', [UserController::class,'signup']);
Route::get('login', [UserController::class,'login']);
Route::post('/signup', [UserController::class,'signup']);
Route::post('/logout', [UserController::class,'logout']);
Route::post('/login', [UserController::class,'login'])->name('login');;

Route::resource('profile', ProfilesController::class);
Route::resource('categories', CategoryController::class);
Route::get('/transactions/all', [TransactionController::class,'showall']);
Route::resource('transactions', TransactionController::class);

Route::resource('budget', BudgetOptController::class);
