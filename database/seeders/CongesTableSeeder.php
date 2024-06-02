<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CongesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('conges')->insert([
            [
                'conge_date_debut' => Carbon::parse('2024-05-01'),
                'conge_date_fin' => Carbon::parse('2024-05-10'),
                'nb_jours' => 10,
                'conge_motif' => 'Vacances',
                'status' => 'actif',
                'agent_id' => 1,
                'type_id' => 1,
                'user_id' => 1,
                'conge_date_creation' => Carbon::now()
            ],
            [
                'conge_date_debut' => Carbon::parse('2024-04-15'),
                'conge_date_fin' => Carbon::parse('2024-04-20'),
                'nb_jours' => 6,
                'conge_motif' => 'Maladie',
                'status' => 'actif',
                'agent_id' => 2,
                'type_id' => 2,
                'user_id' => 2,
                'conge_date_creation' => Carbon::now()
            ],
            // Ajoutez d'autres congés ici
        ]);
    }
}
