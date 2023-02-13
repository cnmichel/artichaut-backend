<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Social>
 */
class SocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->word(),
            'icon'=>fake()->word(),
            'url'=>fake()->url(),
            'order'=>fake()->randomDigit(),
            'lang_id' => fake()->randomElement([1, 2]),
        ];
    }
}
