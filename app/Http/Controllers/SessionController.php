<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Exists;

class SessionController extends Controller
{

    public function create() {

        return view("sessions.create");
    }

    public function store() {

        // Validate the request
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate and log in the user based on the provided credentials
        if (!auth()->attempt($credentials)) {
            // Authentication failed
            return back()->withErrors([
                'email' => 'Your provided credentials could not be verified.',
            ]);
        }

        // Session fixation prevention (session regeneration)
        session()->regenerate();

        // Redirect with a success flash message
        return redirect("/")->with("success", "Welcome Back!");
    }


    public function destroy() {

        auth()->logout();

        return redirect('/')->with('success', 'GoodBye');
    }
}
