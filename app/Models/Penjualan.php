<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kendaraan_id',
        'customer_id',
        'tanggal',
        'jumlah_terjual',
        'tipe_pembayaran',
    ];

    protected $dates = [
        'tanggal',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
