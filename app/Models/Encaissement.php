<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encaissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'facture_id',
        'montant',
        'payer',
        'reste',
        'date',
        'ispayed',
        'user_id'
    ];

    public function facture() : BelongsTo
    {
        return $this->belongsTo(facture::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function personnel() : BelongsTo
    {
        return $this->belongsTo(Personnel::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function materiels() : BelongsTo
    {
        return $this->belongsTo(Materiels::class);
    }

    public function etat() : HasMany
    {
        return $this->hasMany(EtatStockMateriels::class);
    }

    public function caisse() : HasMany
    {
        return $this->hasMany(Caisse::class);
    }

}
