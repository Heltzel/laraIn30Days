<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\testsCongroller;
use App\Http\Controllers\RegisteredUsersController;
use App\Http\Controllers\SessionsController;

Route::view('/', 'home');
Route::view('/contact', 'contact');
// Route::resource('jobs', JobsController::class)->only('index','show')->middleware('auth');
// Route::resource('jobs', JobsController::class)->except(['index','show'])->middleware('auth');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobsController::class, 'create']);
Route::post('/jobs', [JobsController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobsController::class, 'show']);

// 'can:[name of the Gate],[wildcard name]'
// Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])->middleware(['auth', 'can:edit-job,job']);
// Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])
//     ->middleware('auth')
//     ->can('edit-job,job');

// guard it by JobPolicy.php
Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])
    ->middleware('auth')
    ->can('edit,job');

Route::patch('/jobs/{job}', [JobsController::class, 'update']);
Route::delete('/jobs/{job}', [JobsController::class, 'destroy']);

// Auth
Route::get('/register', [RegisteredUsersController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUsersController::class, 'store'])->name('register.store');
Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/login', [SessionsController::class, 'store'])->name('session.store');
Route::delete('/logout', [SessionsController::class, 'destroy'])->name('session.destroy');
