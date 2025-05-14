<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'order_amount', 'order_date'];

    public function user()
    {
        return $this->belongsTo(Order::class, 'user_id');
    }
}
