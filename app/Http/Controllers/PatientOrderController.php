<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientOrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'code' => 'required|string|unique:patient_orders',
            'description' => 'required|string',
            'payment_status' => ['required', Rule::in(['pending', 'paid'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        // Create the patient order
        PatientOrder::create($validatedData);

        return redirect()->back()->with('success', 'Patient order created successfully.');
    }
}
