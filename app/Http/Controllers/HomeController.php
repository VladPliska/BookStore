<?php

namespace App\Http\Controllers;

use App\models\Product as Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {

        $popularBook = Product::all()->random(10);
        
        foreach($popularBook as $v){
            $arr = $v->getOriginal();
            $img = ['image' => "path"];
            array_merge($img,$arr);
            dump($v->getOriginal());
        }

      
        // $test = Storage::disk("img")->get('14245_74857_d.jpg');

        // dd($test);

        return view('page/home');
    }


}
