<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
      protected $guarded = ['id'];
       public function rendezVouses()
    {
        return $this->hasMany(RendezVous::class);
    }
}
