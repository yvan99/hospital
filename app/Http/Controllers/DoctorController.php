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
            'is_hod' => 'boolean',
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
        $departmentId = auth()->user()->department_id;
        $doctors = Doctor::where('department_id', $departmentId)->get();
        return view('doctor.patientOrders', compact('patientOrders', 'doctors'));
    }

    public function assignPatientOrder(Request $request, $orderId)
    {
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

        $patientBatchId = $patientBatch->id;

        $this->handleTimeTable($patientBatchId);

        return redirect()->back()->with('success', 'Patient batch registered successfully.');
    }

    public function consultations()
    {
        $doctorId = auth()->user()->id;
        // Get the doctor's department
        $doctor = Doctor::findOrFail($doctorId);
        $department = $doctor->department_id;
        // Get the nurses in the same department
        $nurses = Nurse::where('department_id', $department)->get();
        $consultations = Consultation::where('doctor_id', $doctorId)->get();
        return view('consultation.index', compact('consultations', 'nurses'));
    }

    public function patientBatches()
    {
        $doctorId = auth()->user()->id;
        $patientBatches = PatientBatch::whereHas('consultation', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->with('consultation.doctor', 'consultation.patientOrder.patient', 'nurses')->get();
        return view('patients.batches', compact('patientBatches'));
    }

    public function nurseBatches()
    {
        $nurseId = auth()->user()->id;

        // Retrieve patient batches assigned to the nurse
        $patientBatches = PatientBatch::whereHas('nurses', function ($query) use ($nurseId) {
            $query->where('nurse_id', $nurseId);
        })->with('consultation.doctor', 'consultation.patientOrder.patient', 'nurses')->get();

        return view('nurse.dashboard', compact('patientBatches'));
    }



    public function handleTimeTable($batchId)
    {
        $nursePatientBatches = BatchPatientNurse::with('nurse', 'patientBatch')
            ->where('patient_batch_id', $batchId)
            ->get();
        $nurses = $nursePatientBatches->pluck('nurse')->unique();
        $patientBatches = $nursePatientBatches->pluck('patientBatch')->unique();
        $patientBatches = PatientBatch::where('status', 'assigned')->get();
        $numberOfDays = 15;
        $nurseCount = count($nurses);
        $patientBatchCount = count($patientBatches);

        for ($i = 0; $i < $numberOfDays; $i++) {
            $date = Carbon::today()->addDays($i);

            $timetables = [];

            $nurseIndex = $i % $nurseCount; // Get the nurse index for the current day

            for ($j = 0; $j < $patientBatchCount; $j++) {
                $patientBatchIndex = ($j + $nurseIndex) % $patientBatchCount; // Get the patient batch index using round-robin

                $nurse = $nurses[$nurseIndex];
                $patientBatch = $patientBatches[$patientBatchIndex];
                // Check if timetable already exists for the date and patient batch
                $existingTimetable = Timetable::where('date', $date)
                    ->where('patient_batch_id', $patientBatch->id)
                    ->first();

                if ($existingTimetable) {
                    // Timetable already exists, skip creating a new one
                    continue;
                }

                $timetable = Timetable::create([
                    'nurse_id' => $nurse->id,
                    'patient_batch_id' => $patientBatch->id,
                    'date' => $date,
                ]);
                // Update the patient batch status to 'processed'
                $patientBatch->update(['status' => 'processed']);
                $timetables[] = $timetable;
                $nurseIndex = ($nurseIndex + 1) % $nurseCount; // Move to the next nurse index
            }
        }
    }


    public function nurseTimetable()
    {
        $nurseTimetables = Timetable::with('nurse', 'patientBatch')
            ->orderBy('date', 'asc')
            ->get();
        $isDuplicate = false;

        foreach ($nurseTimetables as $timetable) {
            $duplicate = Timetable::where('nurse_id', $timetable->nurse_id)
                ->where('patient_batch_id', $timetable->patient_batch_id)
                ->whereDate('date', $timetable->date)
                ->exists();

            if ($duplicate) {
                $isDuplicate = true;
                break;
            }
        }

        return view('scheduling.index', compact('nurseTimetables', 'isDuplicate'));
    }
}
