<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'gender',
        'age',
        'blood_group',
        'insurance',
    ];

    public function patientOrders()
    {
        return $this->hasMany(PatientOrder::class);
    }
}
