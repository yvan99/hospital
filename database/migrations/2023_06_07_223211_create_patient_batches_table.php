<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('patient_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained('consultations');
            $table->json('nurse_ids')->nullable()->after('consultation_id');
            $table->string('code')->unique();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_batches');
    }
}
