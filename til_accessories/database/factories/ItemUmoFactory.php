<?php

namespace Database\Factories;

use App\Models\ItemUmo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemUmoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemUmo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
