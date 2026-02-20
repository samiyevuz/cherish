<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'total_price', 'delivery_price',
        'full_name', 'phone', 'city', 'address', 'payment_method', 'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'delivery_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'accepted'  => 'Qabul qilindi',
            'packing'   => 'Qadoqlanmoqda',
            'shipping'  => 'Yetkazilmoqda',
            'delivered' => 'Yetkazildi',
            default     => $this->status,
        };
    }

    public static function generateOrderNumber(): string
    {
        do {
            $number = 'CTS-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (static::where('order_number', $number)->exists());

        return $number;
    }
}
