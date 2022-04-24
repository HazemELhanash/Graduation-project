<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Shipment;


class Product extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable=[
        'type',
        'option',
        'order_id',
    ];
    public function order(){

        return $this->belongsTo(Order::class, 'order_id');
    }
    public function shipment(){

        return $this->hasMany(Shipment::class, 'product_id');
    }
}
