<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function personnel() : HasMany
    {
        return $this->hasMany(Personnel::class);
    }

    public function service() : HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function materiels() : HasMany
    {
        return $this->hasMany(Materiels::class);
    }

    public function encaissement() : HasMany
    {
        return $this->hasMany(Encaissement::class);
    }

    public function payement() : HasMany
    {
        return $this->hasMany(Payement::class);
    }

    public function decaissement() : HasMany
    {
        return $this->hasMany(Decaissement::class);
    }

    public function payementPersonnel() : HasMany
    {
        return $this->hasMany(PayementPersonnel::class);
    }


}
