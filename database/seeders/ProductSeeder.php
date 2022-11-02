<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'idCategory' => 1,
            'code' => "001",
            'productName' => "Sopa de casa",
            'productShortName' =>"Sopa de casa",
            'description' => "Sopa de fideos con pollo",
            'whitPresentation' => null,
            'isCombo' => false,
            'image' => "imagen/sopa.jpg",
            'precio' => 5,
            'isActive' => true,
            'status' => true,
        ]);
        Product::create([
            'idCategory' => 2,
            'code' => "002",
            'productName' => "Cabrito con yuca",
            'productShortName' =>"Cabrito con yuca",
            'description' => "Guiso de cabrito con yuca y arroz blanco",
            'whitPresentation' => null,
            'isCombo' => false,
            'image' => "imagen/cabrito.jpg",
            'precio' => 12,
            'isActive' => true,
            'status' => true,
        ]);
        Product::create([
            'idCategory' => 3,
            'code' => "003",
            'productName' => "Gaseosa coca-cola",
            'productShortName' =>"Gaseosa coca-cola",
            'description' => "gaseosas personal, litro, 2 litros",
            'whitPresentation' => null,
            'isCombo' => false,
            'image' => "imagen/cocacola.jpg",
            'precio' => 3,
            'isActive' => true,
            'status' => true,
        ]);
        Product::create([
            'idCategory' => 4,
            'code' => "004",
            'productName' => "Gelatina",
            'productShortName' =>"Gelatina",
            'description' => "Gelatina de fresa, piña, limon",
            'whitPresentation' => null,
            'isCombo' => false,
            'image' => "imagen/gelatina.jpg",
            'precio' => 3,
            'isActive' => true,
            'status' => true,
        ]);
        Product::create([
            'idCategory' => 1,
            'code' => "001",
            'productName' => "Ceviche",
            'productShortName' =>"Ceviche",
            'description' => "Ceviche con camote cancha y choclo",
            'whitPresentation' => null,
            'isCombo' => false,
            'image' => "imagen/sopa.jpg",
            'precio' => 5,
            'isActive' => true,
            'status' => true,
        ]);
    }
} 