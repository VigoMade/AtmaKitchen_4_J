<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $table = 'alamat_customer';
    protected $primaryKey = 'id_alamat';
    protected $foreignKey =  ['id_customer'];
    public $timestamps = false;

    protected $fillable = ['alamat_customer', 'id_customer'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
