<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = [
        'title', 'description', 'img','price','ganre','action','watched'
    ];
}
