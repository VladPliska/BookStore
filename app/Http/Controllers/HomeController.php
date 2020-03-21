<?php

namespace App\Http\Controllers;

use App\models\Coments as Comments;
use App\models\Product as Product;
use App\models\User;
use App\models\News as News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $popularBook = Product::where('watched', '>',10)->get()->take(10);

        $actionBook = Product::all()->random(10);
        $news = News::take(20)->get();
        return view('page/home',compact('popularBook','actionBook','news'));
    }

    public function getBook(Request $request,$id){
        $infoBook = Product::where('id',$id)->first();
        $author = $infoBook->author->getOriginal();
        $genre = $infoBook->genre->getOriginal();
        $popularBook = Product::where('watched', '>',10)->get()->take(10);
        $comments = Comments::where('book_id',$id)->take(10)->get();
        return view('page/book-page',compact('author','infoBook','genre','popularBook','comments'));
    }

    public function catalog(Request $request){
        $books = Product::all()->take(30);

        return view('page/filter-page',['data'=>$books]);
    }

    public function searchCatalog(Request $request){
        $result = null;
        $data = [
         'filter' => $request->get('filter'),
         'query' => $request->get('query')
        ];
        if($data['filter'] == "true") {
            $filter = $request->get('filterInfo');
            $minPrice = intval($filter['min-price']) ?? 0;
            $maxPrice = intval($filter['max-price']) ?? 1000;
            $genre = $filter['genre'];
            $author = $filter['author'];
            $sort = $filter['sort'];



            $query = 'select * from "product" where price >'.$minPrice.' and price <'.$maxPrice;

            if(!empty($genre) || !empty($author)) {
                $queryArray = [];
                $query .= ' and ';
                if (!empty($genre)) {
                    array_push($queryArray, '"genre_id"=' . $genre);
                }
                if (!empty($author)) {
                    array_push($queryArray, '"author_id"=' . $author);
                }
                $query .= join(' and ', $queryArray);
            }

            $query .= 'order by price '.$sort;

            $result = DB::select($query);

        }else{
            $result = Product::where('title','ilike','%'.$data['query'].'%')->take(20)->get();
        }


        $view = view('layout/book-card',['search' =>true,'result'=>$result])->render();
        return response()->json([
            'view' =>$view
        ]);
    }

    public function actionPage(){
        $data = Product::where('action',true)->get();

        return view('page/action',compact('data'));

    }

    public  function getNews(){
        $news = News::take(20)->get();
        return view('page.news',compact('news'));
    }

    public function addComment(Request $req){
        $idBook = $req->get('book');
        $idUser = $req->get('user');
        $comment = $req->get('text');
        $live = $req->get('live');
        try {
            Comments::insert([
                'user_id' => $idUser,
                'book_id' => $idBook,
                'coment' => $comment
            ]);
            $userInfo = User::where('id',$idUser)->first();
            $commentBody = view('layout/user-comment',['text'=>$comment,'user'=>$userInfo,'live'=>$live])->render();

            return response()->json([
                'commented'=>true,
                'body'=>$commentBody
            ]);
        }catch (\Exception $e){
            return response()->json([
                'commented'=>false
            ]);
        }
    }

}
