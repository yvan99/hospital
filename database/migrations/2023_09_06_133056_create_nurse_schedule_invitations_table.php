<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateNurseScheduleInvitationsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('nurse_schedule_invitations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('receptionist_id');
                $table->unsignedBigInteger('nurse_id');
                $table->longText('message')->nullable();
                $table->string('direction')->nullable()->default('forward');
                $table->json('payload')->nullable();
                $table->boolean('active_status')->nullable()->default(true);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('nurse_schedule_invitations');
        }
    }
