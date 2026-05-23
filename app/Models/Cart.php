<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'custom_details',
        'quantity',
        'total_price'
    ];

    // Tambahkan cast ini agar Laravel otomatis mengubah teks JSON dari MySQL menjadi Array PHP yang mudah dibaca
    protected $casts = [
        'custom_details' => 'array'
    ];
}