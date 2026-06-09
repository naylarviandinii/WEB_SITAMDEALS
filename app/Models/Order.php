<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status'];

public function user()  { return $this->belongsTo(User::class, 'user_id', 'user_id'); }
// app/Models/Order.php
public function items() {
    return $this->hasMany(OrderItem::class, 'order_id');
}
}
