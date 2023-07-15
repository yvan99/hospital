<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = ['nurse_id', 'patient_batch_id','doctor_id', 'date'];
    protected $dates = ['date'];


    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function patientBatch()
    {
        return $this->belongsTo(PatientBatch::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
