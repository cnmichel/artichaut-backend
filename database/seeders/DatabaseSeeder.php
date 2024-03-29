<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            RoleSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
            ArticleSeeder::class,
            FeatureSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            SitemapSeeder::class,
            SocialSeeder::class,
            PromoSeeder::class,
            HeroSeeder::class,
            VideoSeeder::class,
            AddressSeeder::class,
            PaymentSeeder::class,
            StatusSeeder::class,
            ReservationSeeder::class
        ]);
    }
}
