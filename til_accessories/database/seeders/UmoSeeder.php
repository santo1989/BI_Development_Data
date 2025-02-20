<?php

namespace Database\Seeders;

use App\Models\Umo;
use Illuminate\Database\Seeder;

class UmoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Umo::factory()
            ->count(5)
            ->create();
    }
}
