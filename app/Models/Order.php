<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        'status',
       'note',
       "payment",
       "address"
    ];

    public function order_detail()
    {
        return $this->hasMany(Orderdetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
