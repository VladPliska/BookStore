<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ganre extends Model
{
    protected $table    = "genres";
    protected $fillable = ["name"];


    public function ganreProduct(){
        return $this->hasOne('App\models\Product');
    }
}
