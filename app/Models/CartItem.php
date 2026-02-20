<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'size', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->with('images');
    }

    /**
     * Effective unit price: size-specific price if set, otherwise product's current_price.
     */
    public function getUnitPriceAttribute(): float
    {
        $sizeModel = ProductSize::where('product_id', $this->product_id)
            ->where('size', $this->size)
            ->first();

        if ($sizeModel && $sizeModel->price) {
            return (float) $sizeModel->price;
        }

        return (float) $this->product->current_price;
    }

    public function getSubtotalAttribute(): float
    {
        return $this->unit_price * $this->quantity;
    }
}
