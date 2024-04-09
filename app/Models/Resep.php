<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep';
    public $timestamps = false;

    protected $fillable = ['nama_resep'];
    
    public function detailBahanBaku()
    {
        return $this->hasMany(DetailResepBahanBaku::class, 'id_resep');
    }

    public function totalPenggunaanBahanBaku()
    {
        return $this->detailBahanBaku()->sum('total_penggunaan_bahan');
    }
}
