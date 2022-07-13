<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rest;
use App\Models\Supply;
use App\Models\Ship;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="drivers";
    protected $fillable=[
        'name',
        'phone',
        'address',
        'money'
    ];
    protected $dates=['deleted_at'];


    public function shipment(){

        return $this->hasMany(Shipment::class,'driver_id');
    }
    public function rests(){

        return $this->hasMany(Rest::class,'driver_id');
    }
    public function supplys(){

        return $this->hasMany(Supply::class,'driver_id');
    }
    public function ships(){

        return $this->hasMany(Ship::class,'driver_id');
    }


}
