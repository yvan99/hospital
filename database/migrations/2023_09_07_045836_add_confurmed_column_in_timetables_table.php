<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddConfurmedColumnInTimetablesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('timetables', function (Blueprint $table) {
                $table->boolean('confurmed')->nullable()->default(false);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('timetables', function (Blueprint $table) {
                $table->dropColumn('confurmed');
            });
        }
    }
