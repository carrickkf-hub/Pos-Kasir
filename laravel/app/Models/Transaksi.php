<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'produk_id',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'metode_pembayaran',
        'tanggal_transaksi'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
