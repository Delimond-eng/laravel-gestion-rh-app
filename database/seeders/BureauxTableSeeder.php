<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BureauxTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bureaux')->insert([
            ['bureau_libelle' => 'Bureau A1', 'division_id' => 1, 'user_id'=>1],
            ['bureau_libelle' => 'Bureau B1', 'division_id' => 2, 'user_id'=>1],
            ['bureau_libelle' => 'Bureau C1', 'division_id' => 3, 'user_id'=>1],
            // Ajoutez d'autres bureaux ici
        ]);
    }
}