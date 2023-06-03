<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'tahun_keluaran',
        'warna',
        'harga',
    ];

    public function kendaraanable()
    {
        return $this->morphTo();
    }

    public function stok()
    {
        return $this->hasOne(Stok::class);
    }
}
