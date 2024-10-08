<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory;

    protected $table = "order_details";

    protected $fillable = [
        "product_id",
        'order_id',
        'amount',
        "order_price",
        "order_sale"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
