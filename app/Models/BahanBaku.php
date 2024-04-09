<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id_bahan_baku';
    public $timestamps = false;

    protected $fillable = ['nama_bahan_baku', 'takaran_bahan_baku_tersedia', 'satuan_bahan_baku'];
    
   
}
