<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
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
    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'doctor_id');
    }
}
