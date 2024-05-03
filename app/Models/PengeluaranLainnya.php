<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranLainnya extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pengeluaran_lainnya';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = [
        'nama_pengeluaran_lainnya',
        'biaya_pengeluaran_lainnya',
        'tanggal_pengeluaran_lainnya',
    ];
}
