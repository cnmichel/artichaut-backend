<?php

namespace Database\Seeders;

use App\Models\Sitemap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SitemapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sitemap::factory()
            ->count(10)
            ->create();
    }
}
