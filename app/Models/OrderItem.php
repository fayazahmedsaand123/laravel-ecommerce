<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CardProduct;
use App\Models\Order;
use App\Models\User;

class OrderItem extends Model {
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'seller_id',
        'quantity',
        'price',
        'subtotal',
    ];
    // Relationship with product
    public function product() {
        return $this->belongsTo(CardProduct::class, 'product_id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
?>