<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_batch_id',
        'user_name',
        'user_type',
        'message',
    ];

    public function patientBatch()
    {
        return $this->belongsTo(PatientBatch::class);
    }
}
