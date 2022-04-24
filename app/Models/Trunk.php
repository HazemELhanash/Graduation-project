<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;

class Trunk extends Model
{
    use HasFactory;
    protected $table="trunks";
    protected $fillable=[
        'trunk_code'
    ];

    /*
    public function shipment(){

        return $this->hasMany(Shipment::class,'trunk_id');
    }

    */
}
