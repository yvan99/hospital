<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionistsTable extends Migration
{
    public function up()
    {
        Schema::create('receptionists', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receptionists');
    }
}
