<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
protected $fillable = ['name', 'description', 'price', 'category', 'stock_A', 'stock_B', 'stock_C', 'image'];

public function cartItems() { return $this->hasMany(Cart::class, 'product_id', 'product_id'); }
public function orderItems() { return $this->hasMany(OrderItem::class, 'product_id', 'product_id'); }
}
