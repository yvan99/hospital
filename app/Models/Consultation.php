<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['patient_order_id', 'description', 'doctor_id', 'status', 'code'];

    public function patientOrder()
    {
        return $this->belongsTo(PatientOrder::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patientBatches()
    {
        return $this->hasMany(PatientBatch::class, 'consultation_id');
    }
}
