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
}
