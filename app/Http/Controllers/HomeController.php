<?php

namespace App\Http\Controllers;

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

        return view('page/book-page',compact('author','infoBook','genre','popularBook'));
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
//            dd($sort,$author,$maxPrice,$minPrice,$genre);
//            $result = DB::select('select * from "product"
//                where (price >= ? and price <= ?) and (author_id)',
//                array($minPrice,$maxPrice,$author)
//                );
             $query = 'select * from "product"';
            if(!empty($genre) || !empty($author)){
                $queryArray = [];
                $query.=' where ';
                if(!empty($genre)) {
                    array_push($queryArray,'"genre_id"='.$genre);
                }
                if(!empty($author)) {
                    array_push($queryArray,'"author_id"='.$author);
                }
                $query .= join(' and ', $queryArray);
            }
            dd($query);
            $result = DB::select($query);
            dd($result);
//            (price >= ? and price <= ?)',array($minPrice,$maxPrice));
//            $result = $result->where('author_id',20);
            $result=Product::where('price','>=',$minPrice)->where('price','<=',$maxPrice)
                ->orderBy('price',$sort)->get();
            if($genre){
              $result=Product::where('price','>=',$minPrice)->where('price','<=',$maxPrice)->
                  where('ganre_id',$genre)->orderBy('price',$sort)->get();
            }
            if($author){
                $result=Product::where('price','>=',$minPrice)->where('price','<=',$maxPrice)->
                where('ganre_id',$genre)->orderBy('price',$sort)->get();
            }
            dd($result);
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

}
