<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('absences')->insert([
            [
                'absence_type' => 'absence_justifiee',
                'absence_motif' => 'Rendez-vous médical',
                'status' => 'actif',
                'agent_id' => 2,
                'user_id' => 1,
                'created_at' => Carbon::parse('2024-05-15'),
                'updated_at' => Carbon::parse('2024-05-15')
            ],
            [
                'absence_type' => 'absence_non_justifiee',
                'absence_motif' => 'Non spécifié',
                'status' => 'actif',
                'agent_id' => 1,
                'user_id' => 1,
                'created_at' => Carbon::parse('2024-05-20'),
                'updated_at' => Carbon::parse('2024-05-20')
            ],
            // Ajoutez d'autres absences ici
        ]);
    }
}