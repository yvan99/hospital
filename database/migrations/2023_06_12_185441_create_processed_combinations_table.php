<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessedCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processed_combinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('patient_batch_id');
            $table->integer('count')->default(0);
            $table->timestamps();
            $table->foreign('nurse_id')->references('id')->on('nurses');
            $table->foreign('patient_batch_id')->references('id')->on('patient_batches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processed_combinations');
    }
}
