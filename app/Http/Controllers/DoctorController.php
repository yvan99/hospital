<?php

namespace App\Http\Controllers;

use App\Models\BatchPatientNurse;
use App\Models\Consultation;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\PatientOrder;
use App\Models\PatientBatch;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


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
        $patientOrders = PatientOrder::all();
        $doctors = Doctor::all();
        return view('doctor.patientOrders', compact('patientOrders', 'doctors'));
    }

    public function assignPatientOrder(Request $request, $orderId)
    {
        //TODO: ONLY ASSIGN ORDERS FOR DOCTORS IN THE SAME DEPARTMENT
        // Validate the request data
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'description' => 'required|string',
        ]);

        $patientOrder = PatientOrder::findOrFail($orderId);
        // Update the status of the patient order to 'assigned'
        $patientOrder->status = 'assigned';
        $patientOrder->save();
        $consultation = new Consultation([
            'patient_order_id' => $patientOrder->id,
            'code' => Str::random(15),
            'description' => $validatedData['description'],
            'doctor_id' => $validatedData['doctor_id'],
            'status' => 'assigned',

        ]);

        $consultation->save();
        return redirect()->route('doctors.patientOrders')->with('success', 'Patient consultation batch Assigned successfully.');
    }

    public function registerBatch(Request $request, Consultation $consultation)
    {
        $validatedData = $request->validate([
            'nurse_ids' => 'required|array',
            'nurse_ids.*' => 'exists:nurses,id',
            'code' => 'required|string',
        ]);

        $patientBatch = new PatientBatch([
            'consultation_id' => $consultation->id,
            'code' => $validatedData['code'],
            'status' => "assigned",
        ]);

        $patientBatch->save();

        // Associate nurses with the patient batch
        $patientBatch->nurses()->attach($validatedData['nurse_ids']);

        return redirect()->back()->with('success', 'Patient batch registered successfully.');
    }

    public function consultations()
    {
        $doctorId = auth()->user()->id;
        $consultations = Consultation::where('doctor_id', $doctorId)->get();
        $nurses = Nurse::all(); //TODO: RETURN NURSES IN THE SAME DEPARTMENT
        return view('consultation.index', compact('consultations', 'nurses'));
    }

    public function patientBatches()
    {
        // Get the logged-in doctor's assigned patient batches
        $doctorId = auth()->user()->id;
        $patientBatches = PatientBatch::whereHas('consultation', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->with('consultation.doctor', 'consultation.patientOrder.patient', 'nurses')->get();

        return view('patients.batches', compact('patientBatches'));
    }

    public function generateNurseTimetable()
    {
        $nurses = Nurse::all();
    
        foreach ($nurses as $nurse) {
            $assignedNursePatientBatches = $nurse->assignedPatientBatches()->where('status', 'pending')->get();
    
            $assignedDates = [];
            foreach ($assignedNursePatientBatches as $batch) {
                $assignedDates[] = $batch->created_at->toDateString();
            }
    
            $timetableDates = [];
            foreach ($assignedDates as $date) {
                $timetableDates[] = Carbon::parse($date);
                $timetableDates[] = Carbon::parse($date)->addDays(2);
            }
    
            // Generate the timetable entries
            foreach ($timetableDates as $date) {
                $nursePatientBatch = BatchPatientNurse::where('nurse_id', $nurse->id)
                    ->whereDate('created_at', $date)
                    ->first();
    
                Timetable::create([
                    'nurse_id' => $nurse->id,
                    'nurse_patient_batch_id' => $nursePatientBatch ? $nursePatientBatch->id : null,
                    'date' => $date,
                ]);
            }
        }
    }
    
    

    public function nurseTimetable()
    {
        $this->generateNurseTimetable();
        $nurseTimetables = Timetable::with('nurse', 'patientBatch')->get();
        return view('scheduling.index', compact('nurseTimetables'));
    }
}
