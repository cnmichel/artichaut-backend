<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('langs')->insert([
            ['code' => 'fr-FR', 'label' => 'Français'],
            ['code' => 'en-EN', 'label' => 'English'],
        ]);
    }
}
