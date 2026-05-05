<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'total_amount',
        'payment_method',
        'order_status',
        'address',
        'otp',
        'otp_verified',
        'otp_expires_at',
    ];

    protected $casts = [
        'otp_verified'   => 'boolean',
        'otp_expires_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}