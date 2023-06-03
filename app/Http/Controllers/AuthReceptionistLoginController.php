<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthReceptionistLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.receptionist-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('receptionist')->attempt($credentials)) {
            return redirect()->intended('/receptionist/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('receptionist')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/receptionist/login');
    }
}
