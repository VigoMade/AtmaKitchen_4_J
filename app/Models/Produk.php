<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'id_penitip',
        'id_resep',
        'nama_produk',
        'jenis_produk',
        'stock_produk',
        'tanggal_mulai_po',
        'tanggal_selesai_po',
        'kuota',
        'harga_produk',
        'satuan_produk',
    ];
}
