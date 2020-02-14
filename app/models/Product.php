<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = [
        'title', 'description', 'img','price','genre','action','watched','author_id'
    ];


    public function author(){
        return $this->belongsTo('App\models\Author');
    }

    public function genre(){
        return $this->belongsTo('App\models\Ganre');
    }




}
