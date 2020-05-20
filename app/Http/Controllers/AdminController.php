<?php

namespace App\Http\Controllers;

use App\models\Coments as Comments;
use App\models\Ganre;
use App\models\News;
use App\models\User;
use App\models\Order;
use Illuminate\Http\Request;
use App\models\Product as Product;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    function addBook(Request $request)
    {

        $name = $request->get('nameBook');
        $price = $request->get('price');
        $ganre = $request->get('create-select-ganre');
        $author = $request->get('authorName');
        $desription = $request->get('description');
        $id = $request->get('type');
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

            if($id == null){

                Storage::disk('public')->put('/bookImg',$img);


                Product::create([
                    'title' => $name,
                    'description' => $desription,
                    'price' => $price,
                    'img' => $img->hashName(),
                    'genre_id'=>$ganre,
                    'author_id'=>$author,
                ]);

                return back();
            }
            else{
                $product = Product::where('id',$id)->first();

                if($img == null){
                        $product->update([
                            'title' => $name,
                            'description' => $desription,
                            'price' => $price,
                            'genre_id'=>$ganre,
                            'author_id'=>$author,
                        ]);
                }else{
                    Storage::disk('public')->put('/bookImg',$img);

                    $product->update([
                        'title' => $name,
                        'description' => $desription,
                        'price' => $price,
                        'img' => $img->hashName(),
                        'genre_id'=>$ganre,
                        'author_id'=>$author,
                    ]);
                }
                return back();


            }

    }

    function index()
    {
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
        $genre = Ganre::all();
        return view('page.index-admin', compact('users', 'books', 'club', 'profit',
            'orders', 'monthProfit', 'comments','genre'));

    }

    public function getInfo(Request $req)
    {
        $type = $req->get('type');
//        dd($req);
        if (empty($type)) {
            return response()->json([
                'setData' => 'none',
            ]);
        }
        switch ($type) {
            case 'books':
                $data = Product::take(20)->orderBy('id','desc')->get();
                $view = view('page.admin.book-list', ['books' => $data])->render();
                return response()->json([
                    'setData' => 'admin-all-book',
                    'view' => $view
                ]);
                break;
            case 'users':
                $data = User::take(20)->get();
                $view = view('page.admin.users-list', compact('data'))->render();
                return response()->json([
                    'setData' => 'user-append',
                    'view' => $view
                ]);
                break;
            case 'comments':
                $data = Comments::take(20)->get();
                $view = view('page.admin.comments-list', compact('data'))->render();
                return response()->json([
                    'setData' => 'all-comments',
                    'view' => $view
                ]);
                break;
        }

    }

    public function addNews(Request $req)
    {
        $text = $req->get('text');
        try {
            News::create([
                'text' => $text
            ]);
            return response()->json([
                'news' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'news' => false
            ]);
        }
    }

    public function banUser(Request $req)
    {
        $user = $req->get('id');
        $user = User::find($user)->first();
        if ($user->ban == false) {
            $user->update(['ban' => true]);
            return response()->json([
                'ban' => true
            ]);
        } else {
            $user->update(['ban' => false]);
            return response()->json([
                'ban' => false
            ]);
        }
    }

    public function getBookInfo (Request $req){
        $id = $req->get('id');

        $product = Product::where('id',$id)->first();
        $product->authorname  = $product->author->name;
        return response()->json([
            'info'=>$product
        ]);
    }


    public function deleteBook(Request $req){
            $id = $req->get('id');
            $type = $req->get('type');

            if($type == 'book'){
                $model = Product;
            }else{
                $model = Comments;
            }

            $delete = $model::where('id',$id)->first();

            if($delete){
                $delete->delete();
                return response()->json([
                    'delete'=>true
                ]);
            }else{
                return response()->json([
                    'delete'=>false
                ]);
            }
    }


}
