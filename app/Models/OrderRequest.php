<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    use HasFactory;


    protected $fillable = [
        'tanggal',
        'kode_product',
        'operator_id',
        'nama_komponen',
        'jumlah',
        'jenis_komponen',
        'status',
    ];

    public function operator() {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
