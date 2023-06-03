<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Receptionist extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'names',
        'email',
        'phone',
        'password',
    ];
}
