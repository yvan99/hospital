<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthNurseLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/nurse/dashboard';

    public function __construct()
    {
        $this->middleware('guest:nurse')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.nurse-login');
    }

    protected function guard()
    {
        return auth()->guard('nurse');
    }
    // NurseLoginController.php

    public function logout(Request $request)
    {
        $this->guard('nurse')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/nurse/login');
    }
}
