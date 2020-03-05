<?php

namespace App\Http\Controllers;

use App\models\User;
use App\Order;
use Illuminate\Http\Request;
use App\models\Product as Product;

class AdminController extends Controller
{
    function addBook(Request $request){


        $name = $request->get('nameBook');
        $price = $request->get('price');
        $ganre = $request->get('create-select-ganre');
        $author = $request->get('authorName');
        $desription = $request->get('description');

        $img = $request->file('image');


        if(empty($name)){
            return back()->withErrors(['Name book not found']);
        }

        if(empty($price)){
            return back()->withErrors(['Price book not found']);
        }

        if(empty($ganre)){
            return back()->withErrors(['Ganre book not found']);
        }

        if(empty($author)){
            return back()->withErrors(['Author book not found']);
        }
        if(empty($desription)){
            return back()->withErrors(['Description book not found']);
        }

        if(empty($img->hashName())){
            return back()->withErrors(['Image book not found']);
        }



        Product::create([
            'title'       => $name,
            'description' => $desription,
            'price'       => $price,
            'img'         => $img->hashName()
        ]);

        return view('page/home');
    }

    public function index(){
     $users =  User::count();
     $books = Product::count();
     $club= User::where('club',false)->count();
     $profit = 1000;
//     $orders = Order::where
    }

}
