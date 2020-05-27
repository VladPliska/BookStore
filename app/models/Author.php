<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table    = "authors";
    protected $fillable = ["name"];


    public function authorProduct(){
        return $this->hasOne('App\models\Product');
    }
}
