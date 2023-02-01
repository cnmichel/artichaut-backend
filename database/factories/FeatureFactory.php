<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(3),
            'content' => fake()->sentence(25),
            'icon' => fake()->sentence(1),
            'order' => fake()->randomDigit(),
            'lang_id' => fake()->randomElement([1, 2]),
        ];
    }
}
