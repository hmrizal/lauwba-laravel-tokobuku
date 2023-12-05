<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;
    protected $table = 'sosmed';
    protected $primaryKey = 'id_sosmed';
    protected $fillable = [
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
    ];
}
