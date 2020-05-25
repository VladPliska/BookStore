<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table    = "orders";
    protected $fillable = ["user_id",'price','orderInfo','phone','firstname','lastname','city','email','pay-type','post','status'];
    protected $casts = [
        'orderInfo' => 'array',
    ];
}
