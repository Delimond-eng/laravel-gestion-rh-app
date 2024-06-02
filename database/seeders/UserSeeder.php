<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Gaston dev',
                'email' => 'admin@dev.com',
                'password' => Hash::make('123456'),
                'role'=>'superadmin'
            ],
            [
                'name' => 'Laurent Bukasa',
                'email' => 'laurent@gmail.com',
                'password' => Hash::make('123456'),
                'role'=>'superadmin'
            ]
        ];
        DB::table('users')->insert($users);
    }
}