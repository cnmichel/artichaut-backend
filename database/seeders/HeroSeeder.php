<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heroes')->insert([
            'title' => fake()->sentence(3),
            'subtitle' => fake()->sentence(6),
            'image' => fake()->imageUrl(),
            'cta' => []
        ]);
    }
}
