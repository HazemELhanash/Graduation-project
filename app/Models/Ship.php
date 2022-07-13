<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;


class Ship extends Model
{
    use HasFactory;
    protected $table="ship";
    protected $fillable=[
        'start_at',
        'end_at',
        'driver_id'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
