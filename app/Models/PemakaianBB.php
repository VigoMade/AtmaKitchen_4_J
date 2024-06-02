<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianBB extends Model
{
    use HasFactory;

    protected $table = 'pemakaian_bb'; // Name of the table in the database
    protected $primaryKey = 'id_pemakaian'; // Primary key of the table
    public $timestamps = false; // If your table doesn't have created_at and updated_at columns

    protected $fillable = [
        'id_pemakaian',
        'id_bb',
        'tanggal_pemakaian',
        'total_pemakaian'
    ];

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bb');
    }
}
