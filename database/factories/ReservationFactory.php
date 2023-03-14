<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'start_date'=>fake()->dateTimeInInterval('+1 days', '+3 days'),
            'end_date'=>fake()->dateTimeInInterval('+4 days', '+5 days'),
            'total_reservation' => fake()->randomNumber(4, false),
            'status_id' => fake()->randomElement([1, 2, 3, 4, 5, 6]),
            'payment_id' => fake()->randomElement([1, 2]),
        ];
    }
}
