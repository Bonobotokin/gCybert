<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'materiels_id',
        'prix',
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

    public function materiels() : BelongsTo
    {
        return $this->belongsTo(Materiels::class);
    }
}
