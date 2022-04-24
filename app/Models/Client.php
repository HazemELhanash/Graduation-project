<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;

class Client extends Model
{
    use HasFactory;
    protected $table="shipments";
    protected $fillable=[
        'name',
        'phone',
        'address'
    ];

    /*
    public function shipment(){

        return $this->hasMany(Shipment::class,'client_id');
    }

    */
}
