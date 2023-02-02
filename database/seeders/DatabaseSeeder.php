<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Feature;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LangSeeder::class,
            FeatureSeeder::class,
            ProductSeeder::class,
            SitemapSeeder::class,
            Social::class,
            Promo::class,
        ]);
    }
}
