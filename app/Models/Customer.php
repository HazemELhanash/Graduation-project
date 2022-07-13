<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Shipment;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="customers";
    protected $fillable=[
        'name',
        'phone',
        'address'
    ];
    protected $dates=['deleted_at'];

    public function shipment(){

        return $this->hasMany(Shipment::class, 'client_id');
    }

}
