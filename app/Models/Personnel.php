<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'sexe_personneles',
        'age',
        'salaire_base',
        'telephone',
        'adresse',
        'cin',
        'user_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function facture() : HasMany
    {
        return $this->hasMany(facture::class);
    }
}
