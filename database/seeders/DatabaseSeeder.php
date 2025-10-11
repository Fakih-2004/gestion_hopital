<?php

namespace Database\Seeders;

use App\Models\Medecin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class
        ]);
    }
}
