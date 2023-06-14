<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchPatientNurse extends Model
{
    use HasFactory;
    protected $table = 'nurse_patient_batch';

    protected $fillable = [
        'nurse_id',
        'patient_batch_id',
    ];

    public function nurse()
    {
        return $this->belongsTo(Nurse::class, 'nurse_id');
    }
    

    public function patientBatch()
    {
        return $this->belongsTo(PatientBatch::class, 'patient_batch_id');
    }

    
}
