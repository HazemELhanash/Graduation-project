<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Product;
use App\Models\Car;
use App\Models\Trunk;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Shipment extends Model
{
    // use SearchableTrait;
    use HasFactory;
    use SoftDeletes;
    protected $table="shipment";
    protected $fillable=[
        'load_place',
        'offload_place',
        'elkaam',
        'empty',
        'rest',
        'counter_begin',
        'counter_end',
        'kilometers_per_trip',
        'distnation',
        'policy_number',
        'incoming_value',
        'taxes',
        'order_id',
        'product_id',
        'driver_id',
        'car_id',
        'trunk_id',
        'client_id',
        'status'

    ];
    protected $dates=['deleted_at'];

    public function order(){

        return $this->belongsTo(Order::class,'order_id');
    }

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }


    public function driver(){

        return $this->belongsTo(Driver::class,'driver_id');
    }

    public function car(){

        return $this->belongsTo(Car::class,'car_id');
    }

    public function customer(){

        return $this->belongsTo(Customer::class, 'client_id');
    }

    public function trunk(){

        return $this->belongsTo(Trunk::class,'trunk_id');
    }


}
