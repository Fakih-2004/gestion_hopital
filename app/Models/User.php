<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,HasFactory, Notifiable,HasApiTokens;

    protected $guarded = [
        'id',
    ];
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function medecin()
{
    return $this->hasOne(Medecin::class);
}

public function role()
{
    return $this->belongsTo(Role::class);
}

    public function hasPermission($permissionName)
    {
        return $this->role->permissions()->where('name', $permissionName)->exists();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
