<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanToko extends Model
{
    use HasFactory;
    protected $table = 'ulasantoko';
    protected $primaryKey = 'id_ulto';
    protected $fillable = [
        'id',
        'ulasan',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'id');
    }

}
