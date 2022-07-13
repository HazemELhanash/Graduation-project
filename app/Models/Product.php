<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="products";
    protected $fillable=[
        'type',
        'option',
    ];
    protected $dates=['deleted_at'];

    // public function order(){

    //     return $this->belongsTo(Order::class, 'product_id');
    // }


    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function shipment(){

        return $this->hasMany(Shipment::class, 'product_id');
    }
}
