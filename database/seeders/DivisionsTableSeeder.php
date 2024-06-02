<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('divisions')->insert([
            ['division_libelle' => 'Division A', 'direction_id' => 1, 'user_id'=>1],
            ['division_libelle' => 'Division B', 'direction_id' => 2, 'user_id'=>1],
            ['division_libelle' => 'Division C', 'direction_id' => 3, 'user_id'=>1],
            // Ajoutez d'autres divisions ici
        ]);
    }
}