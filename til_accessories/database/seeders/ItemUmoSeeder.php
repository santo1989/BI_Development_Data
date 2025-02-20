<?php

namespace Database\Seeders;

use App\Models\ItemUmo;
use Illuminate\Database\Seeder;

class ItemUmoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemUmo::factory()
            ->count(5)
            ->create();
    }
}
