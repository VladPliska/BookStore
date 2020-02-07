<?php

namespace App\Http\Controllers;

use App\models\Product as Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $test = Product::create(['title'=>'test','description'=>'test','img'=>'test','price'=>100]);
        dd($test);
        return view('page/home');
    }


}
