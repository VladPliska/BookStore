<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Coments extends Model
{
    protected $table ='coments';
    protected  $fillable =[
        'user_id','book_id','coment'
    ];

    public function books(){
        return $this->belongsTo('App\models\Product','book_id');
    }

    public function user(){
        return $this->belongsTo('App\models\User');
    }

}
