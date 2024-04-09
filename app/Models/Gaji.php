<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    public $timestamps = false;
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'gaji',
        'bonus_gaji',
    ];
}
