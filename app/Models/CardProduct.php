<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class CardProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
    ];

    // Relationship with seller (User)
    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relationship with order items
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
?>
