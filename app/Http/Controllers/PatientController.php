<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|unique:patients',
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'age' => 'required|integer',
            'blood_group' => 'required|string',
            'insurance' => 'nullable|string',
        ]);

        $patient = Patient::where('code', $validatedData['code'])->first();

        if ($patient) {
            return redirect()->route('patients.create')->with('error', 'Patient with the given code already exists.');
        }

        Patient::create($validatedData);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully.');
    }
}
