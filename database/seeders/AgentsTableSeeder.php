<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('agents')->insert([
            [
                'agent_matricule' => 'AGT001',
                'agent_nom' => 'Doe',
                'agent_postnom' => 'Smith',
                'agent_prenom' => 'John',
                'agent_genre' => 'M',
                'agent_telephone' => '1234567890',
                'agent_email' => 'john.doe@example.com',
                'agent_adresse' => '123 Main St',
                'status' => 'actif',
                'agent_date_creation' => Carbon::now(),
                'province_id' => 1,
                'ministere_id' => 1,
                'secretariat_id' => 1,
                'direction_id' => 1,
                'division_id' => 1,
                'bureau_id' => 1,
                'fonction_id' => 1,
                'grade_id' => 1,
                'user_id' => 1
            ],
            [
                'agent_matricule' => 'AGT002',
                'agent_nom' => 'Jane',
                'agent_postnom' => 'Doe',
                'agent_prenom' => 'Mary',
                'agent_genre' => 'F',
                'agent_telephone' => '0987654321',
                'agent_email' => 'mary.jane@example.com',
                'agent_adresse' => '456 Another St',
                'status' => 'actif',
                'agent_date_creation' => Carbon::now(),
                'province_id' => 1,
                'ministere_id' => 1,
                'secretariat_id' => 2,
                'direction_id' => 2,
                'division_id' => 2,
                'bureau_id' => 2,
                'fonction_id' => 2,
                'grade_id' => 2,
                'user_id' => 2
            ],
        ]);
    }
}
