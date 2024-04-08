<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hampers';
    protected $primaryKey = 'id_hampers';
    protected $fillable = [
        'harga_hampers',
        'deskripsi_hampers',
        'nama_hampers',
        'image',

    ];

}

