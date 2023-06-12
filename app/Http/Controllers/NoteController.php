<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\PatientBatch;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'patient_batch_id' => 'required|exists:patient_batches,id',
            'message' => 'required',
        ]);

        Note::create([
            'patient_batch_id' => $request->input('patient_batch_id'),
            'user_name' => auth()->user()->names,
            'user_type' => auth()->getDefaultDriver(),
            'message' => $request->input('message'),
        ]);

        return redirect()->back();
    }

    public function getNotes($patientBatchId)
    {
        $patientBatch = PatientBatch::findOrFail($patientBatchId);
        $notes = $patientBatch->notes()->orderBy('created_at', 'asc')->get();
    
        return view('patients.batches', compact('notes'));

    }
    
}
