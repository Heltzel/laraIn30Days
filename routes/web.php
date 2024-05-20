<?php

use App\Models\Job;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\returnSelf;


Route::get('/', function () {
    return view('home');
});
// N+1 fix : set lazy loading to eager loading
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->paginate(3);
    return view('jobs', [
        'jobs' => $jobs,
    ]);
});
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('show', ['job' => $job]);
});
Route::get('/contact', function () {
    return view('contact');
});

//==========================================================
Route::get('/userroles-attach', function () {
    $user = \App\Models\User::first();
    $roles = \App\Models\Role::all();

    $user->roles()->attach($roles);
    return "Attachet";
});

Route::get('/userroles-attach-by-id', function () {
    $user = \App\Models\User::first();

    $user->roles()->sync([1, 3, 5]);

    return "Attachet by Id and synced";
});
Route::get('/userroles-sync-no-detach', function () {
    $user = \App\Models\User::first();

    $user->roles()->syncWithoutDetaching([2]);

    return "Attachet by Id and synced";
});
//-----------get Pivot data ----------------------------

Route::get('/userroles-pivotdata', function () {
    $user = \App\Models\User::first();

    $user->roles()->sync([
        1 => [
            'name' => 'Victor'
        ]
    ]);

    return $user->roles->first()->pivot->name;
});


Route::get('/userroles-detach', function () {
    $user = \App\Models\User::first();
    $roles = \App\Models\Role::find(2);

    $user->roles()->detach($roles);
    return "Detachet";
});
