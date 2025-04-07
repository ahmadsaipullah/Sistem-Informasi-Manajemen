<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    use HasFactory;

    protected $table = 'order_requests';

    protected $fillable = [
        'kode_komponen_id',
        'operator_id',
        'jumlah',
        'jenis_komponen',
        'status',
        'tanggal_dedline',
    ];

    /**
     * Relasi ke tabel komponens.
     */
    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'kode_komponen_id');
    }

    /**
     * Relasi ke tabel users (operator).
     */
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
