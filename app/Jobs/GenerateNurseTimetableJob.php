<?php

namespace App\Jobs;

use App\Models\Nurse;
use App\Models\Timetable;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class GenerateNurseTimetableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $nurses = Nurse::has('nurseAssignedBatches')->get();
        $numberOfDays = 20;

        Log::info('Nurses:', "dffsmfnfsksfklmsf");

        foreach ($nurses as $nurse) {
            $assignedDates = $nurse->nurseAssignedBatches->pluck('created_at')->map(function ($date) {
                return Carbon::parse($date)->startOfDay();
            });

            $latestDate = $assignedDates->max();

            if ($latestDate) {
                $nextDate = $latestDate->copy()->addDays(2);

                while ($assignedDates->contains($nextDate)) {
                    $nextDate->addDays(2);
                }

                for ($i = 0; $i < $numberOfDays; $i++) {
                    $assignedDate = $assignedDates->contains($nextDate) ? null : $nextDate;

                    Timetable::create([
                        'nurse_id' => $nurse->id,
                        'patient_batch_id' => null,
                        'date' => $assignedDate,
                    ]);

                    $nextDate->addDays(2);
                }
            }
        }
    }
}
