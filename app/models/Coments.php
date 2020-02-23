<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Coments extends Model
{
    protected $table = "coments";

    protected $fillable = ['bookComented','coment','user_id'];

    public function user(){
              return $this->belongsTo('App\models\User');
        }

}
