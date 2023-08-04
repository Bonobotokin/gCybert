<?php

namespace App\Models;

use App\Models\Personnel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayementPersonnel extends Model
{
    use HasFactory;


    protected $fillable = 
    [
        'personnel_id',
        'payement',
        'reste',
        'observation',
        'etat',
        'user_id'
    ];


    public function personnel() : BelongsTo
    {
        return $this->belongsTo(Personnel::class);
    }


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
