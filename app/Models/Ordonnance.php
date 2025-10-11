<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $guarded = ['id'];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }

    public function pharmacieStocks()
    {
        return $this->belongsToMany(PharmacieStock::class, 'ordonnance_stocks')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

    
    public function pharmacien()
    {
        return $this->belongsTo(Pharmacien::class, 'pharmacien_id');
    }

    
    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
