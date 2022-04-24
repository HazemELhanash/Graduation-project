<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;

class Driver extends Model
{
    use HasFactory;
    protected $table="drivers";
    protected $fillable=[
        'name',
        'phone',
        'address',
        'money'
    ];

    /*
    public function shipment(){

        return $this->hasMany(Shipment::class,'driver_id');
    }

    */
}
