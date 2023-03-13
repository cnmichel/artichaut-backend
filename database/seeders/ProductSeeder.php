<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ["name" => "Chambre standard", "price" => 70.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" ,"category_id" => 1, "lang_id" => 1],
            ["name" => "Chambre luxe", "price" => 140.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 1, "lang_id" => 1],
            ["name" => "Chambre suite", "price" => 280.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 1, "lang_id" => 1],
            ["name" => "Formule demie-pension (soir)", "price" => 20.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 2, "lang_id" => 1],
            ["name" => "Formule pension complète (midi + soir)", "price" => 35.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 2, "lang_id" => 1],
            ["name" => "Formule petit déjeuner (matin)", "price" => 9.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 2, "lang_id" => 1],
            ["name" => "Formule petit déjeuner continental (matin)", "price" => 12.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 2, "lang_id" => 1],
            ["name" => "Accès Wifi", "price" => 25.00, "active" => 1 ,"recurrence" => "once","rate" => "room" , "category_id" => 3, "lang_id" => 1],
            ["name" => "Formule télévision", "price" => 10.00, "active" => 1 ,"recurrence" => "weekly","rate" => "room" , "category_id" => 3, "lang_id" => 1],
            ["name" => "Service de pressing tout-compris", "price" => 30.00, "active" => 1 ,"recurrence" => "daily","rate" => "person" , "category_id" => 3, "lang_id" => 1]
        ]);
    }
}
