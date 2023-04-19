<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.create');
    }

    public function store()
    {
        $formData = request()->validate([
            'name' => ['required', 'min:5', 'max:200'],
            'username' => ['required', 'min:5', 'max:200', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        $user = User::create($formData);

        auth()->login($user);

        return redirect("/")->with('success', 'Welcome ' . $user->name);
    }

    public function login()
    {
        return view("auth.login");
    }

    public function post_login()
    {
        $formData = request()->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        if (auth()->attempt($formData)) {
            return redirect('/')->with('success', 'Welcome Back');
        }

        return back()->withErrors([
            'email' => 'Your Email or Password is Wrong',
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect("/")->with('success', 'GoodBye');
    }
}
