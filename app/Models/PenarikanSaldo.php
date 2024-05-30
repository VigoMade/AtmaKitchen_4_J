<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'penarikan_saldo';
    protected $primaryKey = 'id_penarikan';
    protected $fillable = [
        'id_penarikan',
        'id_rekening',
        'total_penarikan',
        'status_penarikan',
        'tanggal_penarikan'
    ];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'id_rekening');
    }
}
