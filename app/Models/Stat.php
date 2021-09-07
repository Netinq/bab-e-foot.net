<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'playtime',
        'points',
        'goals',
        'place_visited',
        'party_played',
    ];
    public $timestamps = false;
}
