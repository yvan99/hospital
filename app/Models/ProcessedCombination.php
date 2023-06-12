<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProcessedCombination extends Model
{
    use HasFactory;
    protected $table = 'processed_combinations';

    protected $fillable = ['nurse_id', 'patient_batch_id', 'count'];

    public function nurse()
    {
        return $this->belongsTo(Nurse::class, 'nurse_id');
    }

    public function patientBatch()
    {
        return $this->belongsTo(PatientBatch::class, 'patient_batch_id');
    }
}

