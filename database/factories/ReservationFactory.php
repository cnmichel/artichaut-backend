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
            'start_date'=>fake()->dateTimeInInterval('-1 week', '+3 days'),
            'end_date'=>fake()->dateTimeInInterval('+5 days', '+10 days'),
            'total_reservation' => fake()->randomNumber(4, false),
            'is_paid' => fake()->boolean(),
            'payment_id' => fake()->randomDigitNot(0),
            'customer_id' => fake()->randomDigitNot(0),
            'address_id' => fake()->randomDigitNot(0),

        ];
    }
}
