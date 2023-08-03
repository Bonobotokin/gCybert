<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'encaissement_id',
        'decaissement_id',
        'solde'
    ];

    public function encaissement() : BelongsTo
    {
        return $this->belongsTo(Encaissement::class);
    }

    public function decaissement() : BelongsTo
    {
        return $this->belongsTo(Decaissement::class);
    }
}
