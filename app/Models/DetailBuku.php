<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DasarBuku;

class DetailBuku extends Model
{
    use HasFactory;
    protected $table = 'detailbuku';
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_detail',
        'id_buku',
        'foto',
        'tanggal_rilis',
        'penerbit',
        'halaman',
        'ukuran',
        'berat'
    ];

    public function dasarBuku(){
        return $this->belongsTo(DasarBuku::class, 'id_buku');
    }
}
