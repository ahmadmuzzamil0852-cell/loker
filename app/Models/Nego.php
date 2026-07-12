<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nego extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'produk_id',
        'jumlah',
        'harga',
        'status',
    ];

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'produk_id'
        );
    }
}