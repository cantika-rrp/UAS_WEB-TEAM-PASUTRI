<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'custom_details', 'quantity', 'price'];

    protected $casts = [
        'custom_details' => 'array'
    ];

    // Relasi balik ke produk katalog
    public function product() {
        return $table->belongsTo(Product::class);
    }
}