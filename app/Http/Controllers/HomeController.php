<?php

namespace App\Http\Controllers;

use App\models\Product as Product;
use Illuminate\Http\Request;



class HomeController extends Controller
{

    public function index()
    {
        $popularBook = Product::where('watched', '>',10)->get()->take(10);
        $actionBook = Product::all()->random(10);
        return view('page/home',compact('popularBook','actionBook'));
    }

    public function getBook(Request $request,$id){

        $infoBook = Product::where('id',$id)->first();
        $author = $infoBook->author->getOriginal();
        $genre = $infoBook->genre->getOriginal();
        $popularBook = Product::where('watched', '>',10)->get()->take(10);
//        dd($ganre,$author);
        return view('page/book-page',compact('author','infoBook','genre','popularBook'));
//        dd($infoBook->getOriginal());

    }

}
