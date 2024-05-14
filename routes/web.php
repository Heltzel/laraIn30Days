<?php

use App\Models\Job;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\returnSelf;


Route::get('/', function () {
    return view('home');
});
Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all(),
    ]);
});
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('show', ['job' => $job]);
});
Route::get('/contact', function () {
    return view('contact');
});
