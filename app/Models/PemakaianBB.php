<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianBB extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pemakaian_bb';
    protected $primaryKey = 'id_pemakaian';
    protected $fillable = ['id_bb', 'id_pemakaian', 'tanggal_pemakaian', 'total_pemakaian'];

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bb');
    }
}
