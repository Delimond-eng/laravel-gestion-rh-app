<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorairesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('horaires')->insert([
            [
                'heure_debut' => '08:00:00',
                'heure_fin' => '17:00:00',
                'heure_retard' => '08:30:00',
                'nbre_retard_notification' => 3,
                'direction_id' => 1,
                'secretariat_id' => 1,
                'ministere_id' => 1,
                'user_id' => 1,
                'date_creation' => now(),
                'status' => 'actif'
            ],
            // Ajoutez d'autres horaires ici
        ]);
    }
}
