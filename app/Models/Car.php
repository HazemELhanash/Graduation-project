<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="cars";
    protected $fillable=[
        'car_number',
        'car_code'
    ];
    protected $dates=['deleted_at'];


    public function shipment(){

        return $this->hasMany(Shipment::class,'car_id');
    }

}
