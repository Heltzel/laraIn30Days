<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\password;

class SessionsController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }
    public function store()
    {
        $attr = request()->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);
        //attempt to authorize the credentials
        if (!Auth::attempt($attr)) {
            throw ValidationException::withMessages(["email" => "Sorry, those credentials do not match"]);
        }

        // re generate session token
        request()->session()->regenerate();
        return redirect('/jobs');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect("/");
    }
}
