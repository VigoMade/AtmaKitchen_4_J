<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'penitip';
    protected $primaryKey = 'id_penitip';
    protected $fillable = [
        'nama_penitip',
        'nama_produk_penitip',
        'jumlah_produk_penitip',
        'jenis_produk_penitip',
        'pembagian_komisi',
        'image',
    ];
}
