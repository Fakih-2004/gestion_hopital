<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacieStock extends Model
{
      protected $guarded = ['id'];

      public function ordonnances()
    {
        return $this->belongsToMany(Ordonnance::class, 'ordonnance_stocks')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

     public function pharmacien()
    {
        return $this->belongsTo(Pharmacien::class);
    }
}
