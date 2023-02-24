<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $customers = Customer::all();


        foreach ($customers as $customer)
        {

            $address = Address::where('customer_id',$customer->id)->first();

            Reservation::factory()
                ->for($customer)
                ->for($address)
                ->create();
        }

    }
}
