<?php

namespace App\Http\Controllers;


use App\Models\Job;
use App\Mail\JobPosted;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Job $job)
    {
        $jobs = $job->with('employer')->paginate(5);
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);
        $request->merge(['employer_id' => 1]);
        $job = Job::create($request->all());

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {  //Moved to AppServiceProvider to make it more available
        // Gate::define('edit-job', function (User $user, Job $job) {
        //     return $job->employer->user->is($user);
        // });

        //By moving the Gate, test for guest is irralevant
        // if (Auth::guest()) {
        //     return redirect()->route('session.create');
        // }

        // if ($job->employer->user->isNot(Auth::user())) {
        //     abort(403);
        // }

        //===================================

        // Gate::authorize('edit-job', $job);
        // Gate protection is set in routes file and AppServiceProviider
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job->update($request->all());
        return redirect()->route('jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index');
    }
}
