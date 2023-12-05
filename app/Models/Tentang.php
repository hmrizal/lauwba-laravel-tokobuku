<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;
    protected $table = 'tentang';
    protected $primaryKey = 'id_tentang';
    protected $fillable = [
        'lokasi',
        'telp',
        'email',
        'deskripsi'
    ];
}
