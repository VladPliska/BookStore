<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Coments extends Model
{
    protected $table ='coments';
    protected  $fillable =[
        'user_id','bookComented','coment'
    ];
}
