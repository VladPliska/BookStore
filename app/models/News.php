<?php

namespace App\models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table    = "news";
    protected $fillable = ["text",'created_at','updated_at'];

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d.m.Y G:i');
    }
//    protected $dateFormat = 'd.m.Y G:i';

}
