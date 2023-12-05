<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    protected $fillable = [
        'id_buku',
        'id',
        'rating',
        'ulasan',
    ];
    public function users() {
        return $this->belongsTo(User::class, 'id');
    }

    public function dasarBuku() {
        return $this->belongsTo(DasarBuku::class, 'id_buku');
    }
}

