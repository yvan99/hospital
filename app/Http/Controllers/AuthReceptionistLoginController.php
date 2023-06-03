<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthReceptionistLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/receptionist/dashboard';

    public function __construct()
    {
        $this->middleware('guest:receptionist')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.receptionist-login');
    }

    protected function guard()
    {
        return auth()->guard('receptionist');
    }

    public function logout(Request $request)
    {
        $this->guard('receptionist')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/receptionist/login');
    }
}
