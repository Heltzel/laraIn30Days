<?php

use App\Http\Controllers\JobsController;
use App\Models\Job;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\returnSelf;


Route::get('/', function () {
    return view('home');
});
//show
// Route::get('posts/{post:slug}')
// slug refers to the column named slug in db 

// N+1 fix : set lazy loading to eager loading
Route::controller(JobsController::class)->group(function () {
    Route::get('/jobs', 'index')->name("jobs.index");
    Route::get('/jobs/create', 'create')->name("jobs.create");
    Route::post('/jobs', 'store')->name("jobs.store");

    Route::get('/jobs/{job}', 'show')->name("jobs.show");
    Route::get('/jobs/{job}/edit', 'edit')->name("jobs.edit");
    Route::patch('/jobs/{job}',  'update')->name("jobs.update");
    Route::delete('/jobs/{job}',  'destroy')->name("jobs.destroy");
});


//==========================================================
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
