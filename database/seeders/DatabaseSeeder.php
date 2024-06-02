<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AgentsTableSeeder::class,
            HorairesTableSeeder::class,
            MinisteresTableSeeder::class,
            SecretariatsTableSeeder::class,
            DirectionsTableSeeder::class,
            DivisionsTableSeeder::class,
            BureauxTableSeeder::class,
            CongesTableSeeder::class,
            AbsencesTableSeeder::class,
            PresencesTableSeeder::class,
        ]);
    }
}
