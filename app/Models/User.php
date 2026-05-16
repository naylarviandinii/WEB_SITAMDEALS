<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'user_id';
protected $fillable = ['name', 'email', 'password', 'role'];

public function carts() { return $this->hasMany(Cart::class, 'user_id', 'user_id'); }
public function orders() { return $this->hasMany(Order::class, 'user_id', 'user_id'); }
    
}
