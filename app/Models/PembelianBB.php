<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBB extends Model
{
    use HasFactory;
    protected $table = 'pembelian_bahan_baku';
    protected $primaryKey = 'id_pembelian';
    protected $foreignKey =  'id_bahan_baku';
    public $timestamps = false;

    protected $fillable = [
        'harga_bahan_baku',
        'tanggal_pembelian',
        'jumlah_bb_dibeli',
        'id_bahan_baku',
    ];

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku');
    }
}
