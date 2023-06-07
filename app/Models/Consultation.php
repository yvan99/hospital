<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    public function patientOrder()
    {
        return $this->belongsTo(PatientOrder::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
