<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'name',
        'price',
        'stock',
        'description',
        'category_id'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
