<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PresencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('presences')->insert([
            [
                'presence_date' => Carbon::parse('2024-06-01'),
                'presence_heure_arrive' => '08:15:00',
                'presence_heure_depart' => '17:00:00',
                'status' => 'actif',
                'agent_id' => 1
            ],
            [
                'presence_date' => Carbon::parse('2024-06-01'),
                'presence_heure_arrive' => '09:00:00',
                'presence_heure_depart' => null,
                'status' => 'actif',
                'agent_id' => 2
            ],
            // Ajoutez d'autres présences ici
        ]);
    }
}
