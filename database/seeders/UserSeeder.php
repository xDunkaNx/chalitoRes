<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'idUser' => 1,
            'userName' => "luis.guarniz",
            'email' => "luis.guarniz@hotmail.com",
            'password' => Hash::make('123456')
        ]
        )->assignRole("Admin");

        User::create([
            'idUser' => 2,
            'userName' => "carlos.mendocilla",
            'email' => "carlos.mendocilla@hotmail.com",
            'password' => Hash::make('123456')
        ])->assignRole("Cajero");

        // User::create([
        //     'userName' => "mario.david",
        //     'email' => "mario.david@hotmail.com",
        //     'password' => Hash::make('123456')
        // ])->assignRole("Cosinero");

        // User::create([
        //     'userName' => "carlos.miranda",
        //     'email' => "carlos.miranda@hotmail.com",
        //     'password' => Hash::make('123456')
        // ])->assignRole("Mesero");
    }
}
