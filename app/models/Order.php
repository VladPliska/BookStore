<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ['user_id','price','book'];
}
