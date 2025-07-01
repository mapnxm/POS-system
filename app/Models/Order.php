<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'customer_id', 
        'total', 
        'payment_type_id', 
        'payment_status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

    public function paymentType()
    {
        return $this->belongsTo(Payments::class);
    }
}
