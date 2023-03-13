<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence(1),
            'price' => fake()->randomFloat(2,1,300),
            'recurrence' =>fake()->randomElement(['once','daily','weekly']),
            'category_id' =>fake()->randomElement([1,2,3]),
            'lang_id' => fake()->randomElement([1, 2])
        ];
    }
}
