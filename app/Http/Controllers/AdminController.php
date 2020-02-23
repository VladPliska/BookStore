<?php

namespace App\Http\Controllers;

use App\models\Coments;
use App\models\Order;
use App\models\User;
use Illuminate\Http\Request;
use App\models\Product as Product;

class AdminController extends Controller
{
    function addBook(Request $request)
    {
        $name = $request->get('nameBook');
        $price = $request->get('price');
        $ganre = $request->get('create-select-ganre');
        $author = $request->get('authorName');
        $desription = $request->get('description');

        $img = $request->file('image');


        if (empty($name)) {
            return back()->withErrors(['Name book not found']);
        }

        if (empty($price)) {
            return back()->withErrors(['Price book not found']);
        }

        if (empty($ganre)) {
            return back()->withErrors(['Ganre book not found']);
        }

        if (empty($author)) {
            return back()->withErrors(['Author book not found']);
        }
        if (empty($desription)) {
            return back()->withErrors(['Description book not found']);
        }

        if (empty($img->hashName())) {
            return back()->withErrors(['Image book not found']);
        }


        Product::create([
            'title' => $name,
            'description' => $desription,
            'price' => $price,
            'img' => $img->hashName()
        ]);

        return view('page/home');
    }

    public function showAdmin()
    {
        $allUser = User::all();
        $allBook = Product::all();
        $allComment=Coments::all();

        $books = array_slice($allBook->all(),0,20);
        $users = array_slice($allUser->all(),0,20);
        $coments = array_slice($allComment->all(),0,20);

        dd($allComment->userComent);

        $bookCount = count($allBook);
        $userCount = count($allUser);
        $comentCount = count($allComment);


        $inClub = 123; /////query because update table
        $allProfit = 1212; ///query because update table

        $allOrder = Order::where('id', ">", "1")->get()->count();
        $priceToMonth = 1221; //query because update table




        return view('page/index-admin', [
            'coment' => $comentCount,
            'orders' => $allOrder,
            'priceMonth' => $priceToMonth,
            'profit' => $allProfit,
            'club' => $inClub,
            'user' => $userCount,
            'book' => $bookCount,
            'listUser'=>$users,
            'listBook'=>$books
        ]);

    }

    public function allBook(){

        $allBook = Product::all()->take(20);

        $view = view('includes/book-item-list',['data' => $allBook]);

        return response()->json([

        ]);
    }

}
