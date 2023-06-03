<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'kendaraan_id',
        'stok',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

}
