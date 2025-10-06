<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacien extends Model
{
         protected $guarded = ['id'];


         public function pharmacieStocks()
    {
        return $this->hasMany(PharmacieStock::class);
    }

}
