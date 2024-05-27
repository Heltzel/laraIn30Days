<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\testsCongroller;
use App\Http\Controllers\RegisteredUsersController;
use App\Http\Controllers\SessionsController;

Route::view('/', 'home');
Route::view('/contact', 'contact');
Route::resource('jobs', JobsController::class);

// Auth
Route::get('/register', [RegisteredUsersController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUsersController::class, 'store'])->name('register.store');
Route::get('/login', [SessionsController::class, 'create'])->name('session.create');
Route::post('/login', [SessionsController::class, 'store'])->name('session.store');
Route::delete('/logout', [SessionsController::class, 'destroy'])->name('session.destroy');
