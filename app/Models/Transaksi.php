<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'user',
        'produk_id',
        'nama_produk',
        'harga',
        'jumlah',
        'total_harga',
        'status',
        'bukti',
    ];

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'produk_id'
        );
    }
}