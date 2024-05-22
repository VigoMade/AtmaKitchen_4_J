<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';
    protected $foreignKey = 'id_transaksi_fk';
    public $timestamps = false;
    protected $fillable = [
        'id_pemasukan',
        'id_transaksi_fk',
        'total_pemasukan',
        'tip',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi_fk');
    }
}
