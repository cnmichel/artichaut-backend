<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rating' => fake()->numberBetween(0,6),
            'title' => fake()->sentence(5),
            'content' => fake()->text(),
            'lang_id' => fake()->randomElement([1, 2]),
        ];
    }
}
