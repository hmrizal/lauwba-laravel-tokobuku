<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $table = 'nota';
    protected $primaryKey = 'id_nota';
    protected $fillable = [
        'id_nota',
        'id',
        'alamat',
        'kode_pos',
        'phone',
        'total_harga'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo(User::class, 'id');
    }

}
