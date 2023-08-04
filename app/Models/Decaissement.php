<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Decaissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'quantite',
        'materiels_id',
        'payement_personnel_id',
        'montant',
        'user_id'
    ];

    public function caisse() : HasMany
    {
        return $this->hasMany(Caisse::class);
    }


    public function materiels() : BelongsTo
    {
        return $this->belongsTo(Materiels::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
