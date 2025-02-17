<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id'
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}