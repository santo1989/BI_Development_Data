<?php

namespace Database\Seeders;

use App\Models\TilAccessories;
use Illuminate\Database\Seeder;

class TilAccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TilAccessories::factory()
            ->count(5)
            ->create();
    }
}
