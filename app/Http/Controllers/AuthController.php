<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
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

        if (!request()->file('profile')) {
            $formData['profile'] = null;
        } else {
            $formData['profile'] = request()->file('profile')->store('profiles');
        }

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

    public function show()
    {
        if (!auth()->user()) {
            return redirect("/users/login");
        }

        return view("auth.show", [
            "user" => auth()->user()
        ]);
    }

    public function edit(User $user)
    {
        return view("auth.edit", [
            "user" => $user
        ]);
    }

    public function update(User $user)
    {

        $formData = request()->validate([
            "name" => ['required', "min:5", "max:200"],
            "username" => ['required', "min:5", "max:200", Rule::unique("users", "username")->ignore($user->id)],
        ]);

        $deleteOldPic = request('deleteOldPic');
        $file = request()->file("profile");

        if ($file) {
            $formData["profile"] = $file->store("profiles");
        } else {
            if ($deleteOldPic) {
                $formData['profile'] = null;
            } else {
                $formData['profile'] = $user->profile;
            }
        }

        DB::table('users')->where('email', $user->email)->update($formData);
        return redirect("/users/profile")->with('success', 'Update Successful');
    }

    public function destroy(User $user)
    {
        if (auth()->user()) {
            auth()->logout();
            DB::table('users')->where('email', $user->email)->delete($user->id);
            return redirect("/");
        }

        return redirect("/users/login");
    }
}
