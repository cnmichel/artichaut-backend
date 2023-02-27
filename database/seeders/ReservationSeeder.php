<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Product;
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
        $products1 = Product::find(1);
        $products2 = Product::all()->random(1)->first();
        $products3 = Product::all()->random(1)->first();


        foreach ($customers as $customer)
        {

            $address = Address::where('customer_id',$customer->id)->first();

            Reservation::factory()
                ->for($customer)
                ->for($address)
                ->hasAttached($products1, ['quantity' => 1, 'total_product' => 1*$products1->price])
                ->hasAttached($products2, ['quantity' => 1, 'total_product' => 1*$products2->price])
                ->hasAttached($products3, ['quantity' => 1, 'total_product' => 1*$products3->price])
                ->create();
        }

    }
}
