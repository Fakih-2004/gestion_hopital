<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdonnanceStock extends Model
{
       protected $guarded = ['id'];

     
    public function ordonnance()
    {
        return $this->belongsTo(Ordonnance::class);
    }

    public function pharmacieStock()
    {
        return $this->belongsTo(PharmacieStock::class);
    }
}
