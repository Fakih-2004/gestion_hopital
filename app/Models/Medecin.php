<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
       protected $guarded = ['id'];
       
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function rendezVouses()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function service()
{
    return $this->belongsTo(Service::class);
}

 public function user()
    {
        return $this->belongsTo(User::class);
    }

}
