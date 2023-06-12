<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBatch extends Model
{
    use HasFactory;

    protected $casts = [
        'nurse_ids' => 'array',
    ];
    protected $fillable = ['consultation_id', 'nurse_id', 'code', 'status'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function nurses()
    {
        return $this->belongsToMany(Nurse::class, 'nurse_patient_batch', 'patient_batch_id', 'nurse_id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
