<?php

namespace Database\Seeders;

use App\Models\Receptionist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Receptionist::factory()->count(10)->create();
    }
}
