<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'service_id',
        'quantite',
        'montant',
        
        'date', 
        'client',
        'user_id',
        'personnel_id'
    ];

    public function encaissement() : HasMany
    {
        return $this->hasMany(Encaissement::class);
    }

    public function personnel() : BelongsTo
    {
        return $this->belongsTo(Personnel::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
