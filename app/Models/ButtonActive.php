<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonActive extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'actif'
    ];

}
