<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    protected $fillable = [
        'id',
        'id_buku',
        'id_nota',
        'jumlah'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'id');
    }

    public function dasarBuku() {
        return $this->belongsTo(DasarBuku::class, 'id_buku');
    }
}
