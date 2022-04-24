<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $fillable=[
        'nawloon',
        'nawloon_value',
        'quantity',
        'driver_money',
        'user_id'
    ];


    public function product(){

        return $this->hasOne(Product::class);
    }
    public function shipment(){

        return $this->hasMany(Shipment::class,'order_id');
    }
    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }
}
