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
        // User::create([
        //     'userName' => "luis.guarniz",
        //     'email' => "luis.guarniz@hotmail.com",
        //     'password' => Hash::make('123456')
        // ])->assignRole("Admin");

        // User::factory(9)->create();
    }
}
