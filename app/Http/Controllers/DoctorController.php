<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\PatientOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $validatedData['password'] = Hash::make($validatedData['password']);
        Doctor::create($validatedData);
        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function index()
    {
        $doctors = Doctor::all();
        $departments = Department::all();

        return view('doctors.index', compact('doctors', 'departments'));
    }

    public function patientOrders()
    {
        // Get the patient orders assigned to the logged-in doctor
        $doctorId = auth()->user()->id;
        $patientOrders = PatientOrder::whereHas('consultation', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->get();

        return view('doctor.patientOrders', compact('patientOrders'));
    }

    public function assignPatientOrder(Request $request, $orderId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nurse_id' => 'required|exists:nurses,id',
            'description' => 'required|string',
        ]);

        // Find the patient order
        $patientOrder = PatientOrder::findOrFail($orderId);

        // Create a new consultation record
        $consultation = new Consultation([
            'patient_order_id' => $patientOrder->id,
            'description' => $validatedData['description'],
            'doctor_id' => auth()->user()->id,
            'nurse_id' => $validatedData['nurse_id'],
            'status' => 'assigned',
        ]);

        // Save the consultation
        $consultation->save();

        return redirect()->route('doctor.patientOrders')->with('success', 'Patient order assigned successfully.');
    }
}
