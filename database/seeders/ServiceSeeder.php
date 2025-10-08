<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['nom' => 'Cardiologie', 'emplacement' => 'Bâtiment A', 'statut' => 'actif'],
            ['nom' => 'Neurologie', 'emplacement' => 'Bâtiment B', 'statut' => 'actif'],
            ['nom' => 'Pédiatrie', 'emplacement' => 'Bâtiment C', 'statut' => 'actif'],
            ['nom' => 'Radiologie', 'emplacement' => 'Bâtiment D', 'statut' => 'actif'],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['nom' => $service['nom']], $service);
        }
    }
}
