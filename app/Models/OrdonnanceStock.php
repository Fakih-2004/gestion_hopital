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
    public function rendezVous() {
         return $this->belongsTo(RendezVous::class); }


    public function medecin() 
    { return $this->belongsTo(Medecin::class); }


    public function patient() { 
        return $this->belongsTo(Patient::class); }

}
