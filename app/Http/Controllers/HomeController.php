<?php

namespace App\Http\Controllers;

use App\models\Product as Product;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        return view('page/book-page',compact('author','infoBook','genre','popularBook'));

    }

}
