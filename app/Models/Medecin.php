<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    protected $guarded = ['id', 'user_id'];

    // Relation avec les plannings
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    // Relation avec les rendez-vous
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    // Relation avec le user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


