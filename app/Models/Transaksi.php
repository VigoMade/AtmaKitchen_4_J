<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $foreignKey =  ['id_customer', 'id_pegawai', 'id_produk_fk'];
    public $timestamps = false;

    protected $fillable = [
        'jumlah_produk',
        'tanggal_transaksi',
        'tanggal_pembayaran',
        'total_pembayaran',
        'status',
        'ongkos_kirim',
        'id_customer',
        'id_pegawai',
        'id_produk_fk',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk_fk');
    }
}
