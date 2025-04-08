<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilProduksi extends Model
{
    use HasFactory;

    protected $table = 'hasil_produksis';

    protected $fillable = [
        'produksi_id',
        'jam',
        'shift',
        'hasil',
        'target',
        'hambatan',
    ];

    public function produksi()
    {
        return $this->belongsTo(WipKomponen::class, 'produksi_id');
    }
}
