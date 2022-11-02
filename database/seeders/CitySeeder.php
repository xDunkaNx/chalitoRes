<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'cityName' => "Trujillo",
            'cityShortName' => "trj",
            'latitude' => null,
            'longitude' => null,
            'main' => false,
            'status' => true
        ]);
        City::create([
            'cityName' => "Chimbote",
            'cityShortName' => "chm",
            'latitude' => null,
            'longitude' => null,
            'main' => false,
            'status' => true
        ]);
        City::create([
            'cityName' => "Lima",
            'cityShortName' => "lm",
            'latitude' => null,
            'longitude' => null,
            'main' => false,
            'status' => true
        ]);
    }
}
