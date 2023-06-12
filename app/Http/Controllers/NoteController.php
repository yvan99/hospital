<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\PatientBatch;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(PatientBatch $patientBatch)
    {
        $notes = Note::where('patient_batch_id', $patientBatch->id)
            ->with('nurse', 'doctor')
            ->latest()
            ->get();

        return view('notes.index', compact('patientBatch', 'notes'));
    }

    public function store(Request $request, PatientBatch $patientBatch)
    {
        $request->validate([
            'message' => 'required',
        ]);

        Note::create([
            'patient_batch_id' => $patientBatch->id,
            'nurse_id' => auth()->user()->id,
            'doctor_id' => $patientBatch->doctor->id,
            'message' => $request->input('message'),
        ]);

        return redirect()->route('notes.index', $patientBatch);
    }
}
