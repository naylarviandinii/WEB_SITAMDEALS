<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'grade', 'qty', 'unit_price'];

public function product() { return $this->belongsTo(Product::class, 'product_id', 'product_id'); }
public function user()    { return $this->belongsTo(User::class, 'user_id', 'user_id'); }
}
