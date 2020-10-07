<?php

namespace Database\Seeders;

use App\Models\Internships;
use Illuminate\Database\Seeder;

class InternshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Internships::factory()->count(5)->create();
    }
}
