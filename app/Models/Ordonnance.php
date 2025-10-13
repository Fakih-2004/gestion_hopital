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
    return $this->belongsTo(User::class, 'pharmacien_id');
}

protected $casts = [
        'instruction_generale' => 'encrypted', 
    ];

}