<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'code',
        'description',
        'payment_status',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}
