<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;

    protected $table = 'mesins';

    protected $fillable = [
        'kode_mesin',
        'nama_mesin',
    ];


    public function WipKomponen()
    {
        return $this->hasMany(WipKomponen::class, 'mesin_id');

    }
}
