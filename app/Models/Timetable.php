<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = ['nurse_id', 'patient_batch_id', 'date'];
    protected $dates = ['date'];


    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function patientBatch()
    {
        return $this->belongsTo(PatientBatch::class);
    }
}
