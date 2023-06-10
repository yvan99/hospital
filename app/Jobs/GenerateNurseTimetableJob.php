<?php

namespace App\Jobs;

use App\Models\BatchPatientNurse;
use App\Models\Timetable;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateNurseTimetableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $nursePatientBatches = BatchPatientNurse::with('nurse', 'patientBatch')->get();
        $numberOfDays = 20;

        for ($i = 0; $i < $numberOfDays; $i++) {
            $date = Carbon::today()->addDays($i);
            $assignedBatches = [];

            foreach ($nursePatientBatches as $nursePatientBatch) {
                $nurse = $nursePatientBatch->nurse;
                $patientBatch = $nursePatientBatch->patientBatch;

                // Check if the patient_batch_id is already assigned on the same day
                if (in_array($patientBatch->id, $assignedBatches)) {
                    continue; // Skip assigning this nurse for this patient_batch_id
                }

                Timetable::create([
                    'nurse_id' => $nurse->id,
                    'patient_batch_id' => $patientBatch->id,
                    'date' => $date,
                ]);

                $assignedBatches[] = $patientBatch->id;
            }
        }
    }
}
