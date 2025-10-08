<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Planning;
use App\Models\Medecin;
use Carbon\Carbon;

class PlanningSeeder extends Seeder
{
    public function run(): void
    {
        $medecins = Medecin::all();

        foreach ($medecins as $medecin) {
            // Pour chaque medecin, on crée 5 jours de tranche horaire
            for ($i = 0; $i < 5; $i++) {
                $date = Carbon::now()->addDays($i)->format('Y-m-d');

                // horaire du matin
                Planning::create([
                    'medecin_id' => $medecin->id,
                    'date' => $date,
                    'date_debut' => $date . ' 09:00:00',
                    'date_fin' => $date . ' 12:00:00',
                ]);

                // horaire de l’apres-midi
                Planning::create([
                    'medecin_id' => $medecin->id,
                    'date' => $date,
                    'date_debut' => $date . ' 14:00:00',
                    'date_fin' => $date . ' 17:00:00',
                ]);
            }
        }
    }
}
