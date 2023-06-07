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
            'password' => 'required|string|min:6',
            'department_id' => 'required|exists:departments,id',
            'is_hod' => 'required|boolean',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        Nurse::create($validatedData);
        return redirect()->route('nurses.index')->with('success', 'Nurse created successfully.');
    }
}
