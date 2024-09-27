<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(),
            'description' => $this->faker->text(),
            'capacity' => $this->faker->randomNumber(4),
            'type_id' => Type::factory()->create()->id,
            'photos' => $this->faker->text(),
            'status' => $this->faker->randomElement([0,1]),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
