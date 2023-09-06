<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class NurseScheduleInvitation extends Model {
        use HasFactory;

        protected $fillable = [
            'nurse_id',
            'receptionist_id',
            'direction',
            'message',
            'payload',
            'active_status'
        ];

        protected $casts = [
            'payload' => 'array'
        ];
    }
