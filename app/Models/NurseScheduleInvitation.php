<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class NurseScheduleInvitation extends Model {
        use HasFactory;

        protected $fillable = [
            'nurse_id',
            'receptionist_id',
            'type',
            'direction',
            'message',
            'payload',
            'active_status',
            'confurmed'
        ];

        protected $casts = [
            'payload' => 'array'
        ];

        public function receptionist() {
            return $this->belongsTo(Receptionist::class);
        }

        public function nurse() {
            return $this->belongsTo(Nurse::class);
        }
    }
