<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $fillable = [
        'names',
        'email',
        'phone',
        'password',
        'department_id',
        'is_hod',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function assignedPatientBatches()
    {
        return $this->hasMany(PatientBatch::class, 'nurse_id');
    }

    public function nurseAssignedBatches()
    {
        return $this->hasMany(BatchPatientNurse::class, 'nurse_id');
    }

    public function patientBatches()
    {
        return $this->belongsToMany(PatientBatch::class, 'nurse_patient_batch', 'nurse_id', 'patient_batch_id');
    }
}
