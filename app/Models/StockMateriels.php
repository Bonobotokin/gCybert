<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockMateriels extends Model
{
    use HasFactory;

    protected $fillable = [
        'materiels_id',
        'quantite',
2    ];


    public function materiels() : BelongsTo
    {
        return $this->belongsTo(Materiels::class);
    }

    public function etatStockMateriels() : HasMany
    {
        return $this->hasMany(EtatStockMateriels::class);
    }
}
