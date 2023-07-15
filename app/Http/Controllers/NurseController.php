<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NurseController extends Controller
{
    public function index()
    {
        $nurses = Nurse::all();
        $departments = Department::all();
        return view('nurses.index', compact('nurses', 'departments'));
    }


    public function create()
    {
        return view('nurses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'names' => 'required|string|max:255',
            'email' => 'required|email|unique:nurses',
            'phone' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'is_hod' => 'boolean',
        ]);

        $doController = new DoctorController;
        $callSms = new SmsController;
        $generatedPassword=$doController->generatePassword();
        $validatedData['password'] = Hash::make($generatedPassword);

        $nurse = Nurse::create($validatedData);

        $message = 'Hello ' . $nurse->names . ', Welcome ! Your Nurse account is created successfully Your password is: ' . $generatedPassword;
        $callSms->sendSms($request->phone, $message);

        return redirect()->route('nurses.index')->with('success', 'Nurse created successfully. Password Sent to User via SMS');
    }
}
