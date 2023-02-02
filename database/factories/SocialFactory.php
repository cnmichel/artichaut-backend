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
            'name'=>fake()->sentences(1),
            'icon'=>fake()->url(),
            'url'=>fake()->url(),
            'order'=>fake()->shuffle([1,2,3,4,5,6]),
            'lang_id' => fake()->randomElement([1, 2]),
        ];
    }
}
