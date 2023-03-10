<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'name' => 'pending',
                'label_fr' => 'En attente de paiement',
                'label_en' => 'Pending'
            ],
            [
                'name' => 'ongoing',
                'label_fr' => 'Réservation en cours',
                'label_en' => 'Ongoing'
            ],
            [
                'name' => 'confirmed',
                'label_fr' => 'Réservation confirmer',
                'label_en' => 'Confirmed'
            ],
            [
                'name' => 'canceled',
                'label_fr' => 'Réservation annuler',
                'label_en' => 'Canceled'
            ],
            [
                'name' => 'expired',
                'label_fr' => 'Réservation expirée',
                'label_en' => 'Expired'
            ],
            [
                'name' => 'completed',
                'label_fr' => 'Réservation terminée',
                'label_en' => 'Completed'
            ],
            [
                'name' => 'rejected',
                'label_fr' => 'Paiement rejeter',
                'label_en' => 'Rejected'
            ],
        ]);
    }
}
