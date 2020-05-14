<?php

namespace App\Http\Controllers;

use App\models\Coments as Comments;
use App\models\News;
use App\models\User;
use App\models\Order;
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

     function index(){
//     $users =  User::count();
//     $books = Product::count();
//     $club= User::where('club',true)->count();
      $club = 100;
     $profit = 1000;
//     $orders = Order::count();
     $monthProfit = 10000000;
//     $comments = Comments::count();
    $users = 100;
    $books = 100;
    $orders = 100;
    $comments = 200;
     return view('page.index-admin',compact('users','books','club','profit',
                                            'orders','monthProfit','comments'));

    }

     public function getInfo(Request $req){
        $type = $req->get('type');
//        dd($req);
        if(empty($type)){
            return response()->json([
                'setData' => 'none',
            ]);
        }
        switch($type){
            case 'books':
                $data = Product::take(20)->get();
                $view = view('page.admin.book-list',['books'=>$data])->render();
                return response()->json([
                    'setData'=>'admin-all-book',
                    'view' => $view
                ]);
                break;
            case 'users':
                $data = User::take(20)->get();
                $view = view('page.admin.users-list',compact('data'))->render();
                return response()->json([
                    'setData' => 'user-append',
                    'view' => $view
                ]);
                break;
            case 'comments':
                $data = Comments::take(20)->get();
                $view = view('page.admin.comments-list',compact('data'))->render();
                return response()->json([
                    'setData' =>'all-comments',
                    'view' => $view
                ]);
                break;
        }

    }

    public function addNews(Request $req){
        $text = $req->get('text');
         try{
             News::create([
                 'text'=>$text
             ]);
             return response()->json([
                 'news'=>true
             ]);
         }catch (\Exception $e){
             return response()->json([
                 'news'=>false
             ]);
         }
    }


}
