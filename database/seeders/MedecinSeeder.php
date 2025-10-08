<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Medecin;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MedecinSeeder extends Seeder
{
    public function run(): void
    {
        
        $roleMedecin = Role::firstOrCreate(['name' => 'medecin']);

    
        $services = Service::all();
        if ($services->isEmpty()) {
            $this->command->info('Aucun service trouvé, créez d’abord les services.');
            return;
        }


        $medecins = [
            ['nom' => 'Rabab',  'prenom' => 'Talbi',  'email' => 'rabab@hopital.com',  'tele' => '0656352786', 'specialite' => 'Cardiologie', 'password' => 'Rabab1@123'],
            ['nom' => 'Aya',  'prenom' => 'Baghbar', 'email' => 'Aya@hopital.com',  'tele' => '0656345678', 'specialite' => 'Neurologie', 'password' => 'Aya2@123'],
            ['nom' => 'Hajar',  'prenom' => 'Fakih',  'email' => 'Hajar@hopital.com',  'tele' => '0656334455', 'specialite' => 'Pédiatrie',  'password' => 'Hajar3@123'],
            ['nom' => 'Laila',  'prenom' => 'Idrissi','email' => 'laila@hopital.com',  'tele' => '0656321122', 'specialite' => 'Radiologie', 'password' => 'lela4@123'],
            ['nom' => 'Youssef','prenom' => 'Elami',  'email' => 'youssef@hopital.com','tele' => '0656319988', 'specialite' => 'Dermatologie','password' => 'yusef5@123'],
        ];

        foreach ($medecins as $data) {
           
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => 'Dr. ' . $data['nom'] . ' ' . $data['prenom'],
                    'password' => Hash::make($data['password']),
                    'phone' => $data['tele'],
                ]
            );

            $user->assignRole($roleMedecin);

            
            Medecin::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'specialite' => $data['specialite'],
                    'service_id' => $services->random()->id,
                    'statut' => 'actif',
                ]
            );

            $this->command->info("Medecin seeded: email={$data['email']} password={$data['password']}");
        }
    }
}
