<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthNurseLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.nurse-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('nurse')->attempt($credentials)) {
            return redirect()->intended('/nurse/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('nurse')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/nurse/login');
    }
}
