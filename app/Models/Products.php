<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'category',
        'merchant_id'
    ];

    // Define available categories
    const CATEGORY_FRUIT = 'fruit';
    const CATEGORY_VEGETABLE = 'vegetable';

    public static function getCategories()
    {
        return [
            self::CATEGORY_FRUIT => 'Fruit',
            self::CATEGORY_VEGETABLE => 'Vegetable'
        ];
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
