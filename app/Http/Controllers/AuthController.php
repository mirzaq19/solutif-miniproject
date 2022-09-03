<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $login_type = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (auth()->attempt([$login_type => $email, 'password' => $password], $request->has('remember'))) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->withErrors([
            'invalid' => 'Email atau password yang dimasukkan salah.'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
