<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
            'user_name' => auth()->user()->name,
            'user_type' => auth()->getDefaultDriver(),
            'message' => $request->input('message'),
        ]);

        return redirect()->back();
    }
}
