<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
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

}
