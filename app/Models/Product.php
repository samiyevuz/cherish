<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'sale_price', 'is_new', 'is_featured',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $primary = $this->primaryImage;
        if ($primary) {
            return self::resolveImageUrl($primary->image_path);
        }
        $first = $this->images->first();
        if ($first) {
            return self::resolveImageUrl($first->image_path);
        }
        return 'https://picsum.photos/seed/' . $this->id . '/600/800';
    }

    public static function resolveImageUrl(string $path): string
    {
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        return asset('storage/' . $path);
    }

    public function getCurrentPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    public function getTotalStockAttribute(): int
    {
        return $this->sizes->sum('stock');
    }
}
