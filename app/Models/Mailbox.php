<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    use HasFactory;
    protected $table = 'mailbox';
    protected $primaryKey = 'id_mailbox';
    protected $fillable = [
        'nama',
        'email',
        'judul',
        'pesan'
    ];
}
