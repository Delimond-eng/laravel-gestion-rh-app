<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecretariatsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('secretariats')->insert([
            ['secretariat_libelle' => 'Secrétariat de l\'Education Primaire', 'ministere_id' => 1, 'user_id'=>1],
            ['secretariat_libelle' => 'Secrétariat de l\'Education Secondaire', 'ministere_id' => 1, 'user_id'=>1],
            ['secretariat_libelle' => 'Secrétariat de la Santé Publique', 'ministere_id' => 2, 'user_id'=>1],
        ]);
    }
}