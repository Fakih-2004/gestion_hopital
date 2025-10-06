<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facturation extends Model
{
   protected $guarded = ['id'];
    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }
    public function patient() { return $this->belongsTo(Patient::class); }

    public function medecin() { return $this->belongsTo(Medecin::class); }

}
