<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'rekening';
    protected $primaryKey = 'id_rekening';
    protected $fillable = [
        'id_rekening',
        'id_customer',
        'rekening_bank',
        'nama_bank',
        'rekening_aktif',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
