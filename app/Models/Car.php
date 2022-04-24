<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;

class Car extends Model
{
    use HasFactory;
    protected $table="cars";
    protected $fillable=[
        'car_number',
        'car_code'
    ];

    /*
    public function shipment(){

        return $this->hasMany(Shipment::class,'car_id');
    }
    */
}
