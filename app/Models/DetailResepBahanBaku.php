<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResepBahanBaku extends Model
{
    protected $table = 'detail_resep_bahan_baku';
    protected $primaryKey = ['id_resep', 'id_bahan_baku'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['deskripsi_resep_produk', 'total_penggunaan_bahan', 'id_bahan_baku', 'id_resep'];
    
    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku');
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }
}
