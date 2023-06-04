<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'names' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors',
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
            'department_id' => 'required|exists:departments,id',
            'is_hod' => 'required|boolean',
        ]);

        // Create the doctor
        Doctor::create($validatedData);

        // Redirect to the doctor listing page
        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function index()
    {
        $doctors = Doctor::all();
        $departments = Department::all();

        return view('doctors.index', compact('doctors', 'departments'));
    }
}
