<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'nama',
        'alamat',
        'kodepos',
        'telp',
        'email',
        'password'
    ];

    public function getAuthPassword(){
        return $this->password;
    }

}
