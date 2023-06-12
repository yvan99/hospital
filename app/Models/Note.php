<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['patient_batch_id', 'nurse_id', 'doctor_id', 'message'];

    public function patientBatch()
    {
        return $this->belongsTo(PatientBatch::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
