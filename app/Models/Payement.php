<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'materiels_id',
        'quantite',
        'montant',
        'user_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function materiels() : BelongsTo
    {
        return $this->belongsTo(Materiels::class);
    }
}
