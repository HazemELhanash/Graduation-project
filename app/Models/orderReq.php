<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class orderReq extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="order_reqs";
    protected $fillable=[
        'name',
        'phone_1',
        'phone_2',
        'email',
        'adress',
        'product_type',
        'quantity',
        'details'
    ];
}

