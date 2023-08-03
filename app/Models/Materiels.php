<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materiels extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'designation',
        'totale',
        // 'prix_vente',
        'conditionnement',
        'user_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function encaissement() : HasMany
    {
        return $this->hasMany(Encaissement::class);
    }

    public function decaissement () : HasMany
    {
        return $this->hasMany(Decaissement::class);
    }

    public function service() : HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function stockMateriels() : HasMany
    {
        return $this->hasMany(StockMateriels::class);
    }
}
