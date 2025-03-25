<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;

    protected $table = 'komponens';

    protected $fillable = [
        'kode_komponen',
        'nama_komponen',
        'stok',
    ];

    /**
     * Relasi ke tabel order_requests.
     */
    public function orderRequests()
    {
        return $this->hasMany(OrderRequest::class, 'kode_komponen_id');
    }
}
