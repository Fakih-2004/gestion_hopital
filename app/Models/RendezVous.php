<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
      protected $guarded = ['id'];
      
      public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function facturation()
    {
        return $this->hasOne(Facturation::class);
    }

    public function ordonnance()
    {
        return $this->hasOne(Ordonnance::class);
    }
}
