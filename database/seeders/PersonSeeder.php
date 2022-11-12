<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::create([
            'personName' => "luis",
            'personMiddleName' => "felipe",
            'personLastName' => "guarniz lavado",
            'status' => 1,
            'typeDocument' => "DNI",
            'document' => "12345678",
            'ruc' => "",
            'razonSocial' => "",
            'dob' => "1988-04-12",
            'age' => "34",
            'email' => "luis.guarniz@hotmail.com",
            'phone' => "123456789",
            'cellPhone' => "123456789",
            'address' => "chira",
            'contactName' => "",
            'contactPhone' => ""
        ]
        );
        Person::create([
            'personName' => "Harold",
            'personMiddleName' => "Gianpierre",
            'personLastName' => "Guerrero Bello",
            'status' => 1,
            'typeDocument' => "DNI",
            'document' => "12345678",
            'ruc' => "",
            'razonSocial' => "",
            'dob' => "1988-04-12",
            'age' => "34",
            'email' => "harold.guerrero@hotmail.com",
            'phone' => "123456789",
            'cellPhone' => "123456789",
            'address' => "Rimac",
            'contactName' => "",
            'contactPhone' => ""
        ]
        );
        Person::create([
            'personName' => "carlos",
            'personMiddleName' => "eli",
            'personLastName' => "mendocilla ponce",
            'status' => 1,
            'typeDocument' => "DNI",
            'document' => "12345678",
            'ruc' => "",
            'razonSocial' => "",
            'dob' => "1988-04-12",
            'age' => "34",
            'email' => "carlos.eli@hotmail.com",
            'phone' => "123456789",
            'cellPhone' => "123456789",
            'address' => "chira",
            'contactName' => "",
            'contactPhone' => ""
        ]
        );
    }
}
