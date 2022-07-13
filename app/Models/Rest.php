<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Rest extends Model
{
    use HasFactory;
    protected $table="rest";
    protected $fillable=[
        'start_at',
        'end_at',
        'driver_id',
        'shipment_number'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
