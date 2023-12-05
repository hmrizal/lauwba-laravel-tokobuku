<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Penulis;
use App\Models\DetailBuku;

class DasarBuku extends Model
{
    use HasFactory;
    protected $table = 'dasarbuku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        'id_buku',
        'judul',
        'id_penulis',
        'id_genre',
        'harga_asli',
        'diskon',
        'stok',
        'sinopsis'
    ];

    public function genre(){
        return $this->belongsTo(Genre::class, 'id_genre');
    }

    public function penulis(){
        return $this->belongsTo(Penulis::class, 'id_penulis');
    }

    public function detailBuku()
    {
        return $this->hasOne(DetailBuku::class, 'id_buku');
    }

    public function cart() {
        return $this->hasMany(Cart::class, 'id_buku');
    }
}
