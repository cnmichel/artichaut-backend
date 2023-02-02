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
            UserSeeder::class,
            RoleSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
            ArticleSeeder::class,
            LangSeeder::class,
            FeatureSeeder::class,
            ProductSeeder::class,
            SitemapSeeder::class,
            SocialSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
