<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roleAdmin = Role::create(["name" => "Admin"]);
      $roleCajero = Role::create(["name" => "Cajero"]);
      $roleCosinero = Role::create(["name" => "Cosinero"]);
      $roleMesero = Role::create(["name" => "Mesero"]);
      
      Permission::create(["name" => 'getAllUser'])->assignRole($roleAdmin);

      Permission::create(["name" => 'createOrUpdateCategory'])->assignRole($roleAdmin);
      Permission::create(["name" => 'getCategory'])->assignRole($roleAdmin);
      Permission::create(["name" => 'getCategoryName'])->assignRole($roleAdmin);

      Permission::create(["name" => 'createOrUpdateProduct'])->assignRole($roleAdmin);
      Permission::create(["name" => 'deleteProduct'])->assignRole($roleAdmin);
      Permission::create(["name" => 'getProduct'])->assignRole($roleAdmin);
    }
}
