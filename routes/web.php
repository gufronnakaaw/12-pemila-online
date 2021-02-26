<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaptopsController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->middleware('isLogged');
Route::get('/thanks', function(){
    return view('thanks');
})->middleware('isLogged');
Route::post('/', [HomeController::class, 'create'])->middleware('isLogged');


// auth
Route::view('/login', 'auth.login')->middleware('AlreadyLoggedIn')->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/checkLogin', [AuthController::class, 'checkLogin'])->name('auth.checkLogin');


// dashboard
// administrator
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('isLogged')->middleware('CheckRole');
Route::get('/profile/{user:username}', [AdminController::class, 'profile'])->middleware('isLogged')->middleware('CheckRole');
Route::get("/settings/{user:username}", [AdminController::class, 'settings'])->middleware('isLogged')->middleware('CheckRole');
Route::patch('/settings/update', [AdminController::class, 'update']);

// users
Route::get('/users', [AdminController::class, 'users'])->middleware('isLogged')->middleware('CheckRole');
Route::get('/users/create', [AdminController::class, 'create'])->middleware('isLogged')->middleware('CheckRole');
Route::get('/users/edit/{user}', [AdminController::class, 'edit'])->middleware('isLogged')->middleware('CheckRole');
Route::post('/users/store', [AdminController::class, 'store'])->middleware('isLogged')->middleware('CheckRole');
Route::patch('/users/updateUser', [AdminController::class, 'updateUser'])->middleware('isLogged')->middleware('CheckRole');
Route::delete('/users/delete/{user}', [AdminController::class, 'destroy'])->middleware('isLogged')->middleware('CheckRole');

// menu
Route::get('/laptops', [LaptopsController::class, 'index'])->middleware('isLogged')->middleware('CheckRole');
Route::get('/laptops/create', [LaptopsController::class, 'create'])->middleware('isLogged')->middleware('CheckRole');
Route::get('/laptops/edit/{laptop}', [LaptopsController::class, 'edit'])->middleware('isLogged')->middleware('CheckRole');
Route::post('/laptops/store', [LaptopsController::class, 'store'])->middleware('isLogged')->middleware('CheckRole');
Route::patch('/laptops/update', [LaptopsController::class, 'update'])->middleware('isLogged')->middleware('CheckRole');
Route::delete('/laptops/delete/{laptop}', [LaptopsController::class, 'destroy'])->middleware('isLogged')->middleware('CheckRole');