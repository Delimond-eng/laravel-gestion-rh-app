<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('directions')->insert([
            ['direction_libelle' => 'Direction de l\'Enseignement Primaire', 'secretariat_id' => 1, 'user_id'=>1 ],
            ['direction_libelle' => 'Direction de l\'Enseignement Secondaire', 'secretariat_id' => 2, 'user_id'=>1],
            ['direction_libelle' => 'Direction de la Santé Publique', 'secretariat_id' => 3, 'user_id'=>1],
            // Ajoutez d'autres directions ici
        ]);
    }
}