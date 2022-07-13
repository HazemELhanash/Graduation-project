<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
class Supply extends Model
{
    use HasFactory;

    protected $table="supply";
    protected $fillable=[
        'start_at',
        'end_at',
        'driver_id',
        'shipment_number',
        'image_path'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
