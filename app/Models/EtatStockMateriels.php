<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EtatStockMateriels extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_materiels_id',
        'facture_id',
        'quantite',
        'observation',
    ];

    public function stockMateriels() : BelongsTo
    {
        return $this->belongsTo(StockMateriels::class);
    }

    public function encaissement() : BelongsTo
    {
        return $this->belongsTo(Encaissement::class);
    }
}
