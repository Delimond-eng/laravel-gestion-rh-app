<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinisteresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ministeres')->insert([
            ['ministere_libelle' => 'Ministère de l\'Education', 'user_id'=>1],
            ['ministere_libelle' => 'Ministère de la Santé', 'user_id'=>1],
        ]);
    }
}