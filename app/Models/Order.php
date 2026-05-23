<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'shipping_address', 'phone_number', 'status', 'notes'];

    // Relasi ke item pesanan
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}