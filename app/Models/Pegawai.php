<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'id_role',
        'nama_pegawai',
        'telepon_pegawai',
        'email_pegawai',
        'gaji',
        'username_pegawai',
        'password_pegawai',
        'foto'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_role', 'id_role');
    }
}
