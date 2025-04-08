<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WipKomponen extends Model
{
    use HasFactory;

    protected $table = 'wip_komponens';

    protected $fillable = [
        'komponen_id',
        'mesin_id',
        'lokasi',
        'tanggal_out',
        'jumlah_out',
        'status',
    ];

    /**
     * Relasi ke OrderRequest (as komponen_id)
     */
    public function orderRequest()
    {
        return $this->belongsTo(OrderRequest::class, 'komponen_id');
    }

    /**
     * Relasi ke Mesin
     */
    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'mesin_id');
    }

        public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'kode_komponen_id');
    }

    public function HasilProduksi()
    {
        return $this->hasMany(HasilProduksi::class, 'produksi_id');

    }

}
