<?php
use Illuminate\Database\Eloquent\Model;
class PatientBatch extends Model
{
    protected $fillable = ['consultation_id', 'nurse_id', 'code', 'status'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
