<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthDoctorLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/doctor/dashboard';

    public function __construct()
    {
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.doctor-login');
    }

    protected function guard()
    {
        return auth()->guard('doctor');
    }
}
