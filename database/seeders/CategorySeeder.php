<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'categoryName' => "Entrada",
            'isActive' => true,
            'status' => true
        ]);
        Category::create([
            'categoryName' => "Fondo",
            'isActive' => true,
            'status' => true
        ]);
        Category::create([
            'categoryName' => "Bebida",
            'isActive' => true,
            'status' => true
        ]);
        Category::create([
            'categoryName' => "Postre",
            'isActive' => true,
            'status' => true
        ]);
    }
}
