<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Medecin;
use App\Models\Patient;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        //create admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@hopital.com'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('admin123'),
                'phone' => '0600000000'
            ]
        );
        $admin->assignRole('admin');

        //secretaire
        $secretaryUser = User::firstOrCreate(
            ['email' => 'Sara@hopital.com'],
            [
                'name' => 'Sara secretaire',
                'password' => Hash::make('Sara123'),
                'phone' => '0600333444'
            ]
        );
        $secretaryUser->assignRole('secretaire');

        //create users random
        $roles = Role::whereNotIn('name', ['admin'])->pluck('name')->toArray();

        User::factory(10)->create()->each(function ($user) use ($roles) {
            $role = fake()->randomElement($roles);
            $user->assignRole($role);

       
            if ($role === 'medecin') {
                Medecin::create([
                    'user_id' => $user->id,
                    'specialite' => fake()->randomElement(['Cardiologie', 'Dermatologie', 'Pédiatrie', 'Neurologie']),
                    'statut' => 'actif',
                    'service_id' => null,
                ]);
            }

            if ($role === 'patient') {
                Patient::create([
                    'user_id' => $user->id,
                    'adresse' => fake()->address(),
                    'date_naissance' => fake()->date('Y-m-d', '2005-01-01'),
                    'is_new' => fake()->boolean(),
                ]);
            }
        });
    }
}
