<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_percentage',
        'discounted_price',
        'quantity',
        'allow_preorder',
        'category_id',
        'main_category',
        'images',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'images' => 'array',
        'allow_preorder' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getIsInStockAttribute()
    {
        return $this->quantity > 0;
    }

    public function getFinalPriceAttribute()
    {
        return $this->discounted_price ?? $this->price;
    }
}
