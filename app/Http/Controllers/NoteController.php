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
            'nurse_id' => auth()->user()->id,
            'doctor_id' => PatientBatch::find($request->input('patient_batch_id'))->doctor_id,
            'message' => $request->input('message'),
        ]);

        return redirect()->back();
    }
}
