<?php

namespace App\Http\Controllers;

use App\models\Author;
use App\models\Coments as Comments;
use App\models\Ganre;
use App\models\Product as Product;
use App\models\User;
use App\models\News as News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;


class HomeController extends Controller
{
    public function index()
    {
        $popularBook = Product::where('watched', '>', 10)->get()->take(10);

        $actionBook = Product::all()->random(10);
        $news = News::take(20)->get();
        return view('page/home', compact('popularBook', 'actionBook', 'news'));
    }

    public function getBook(Request $request, $id)
    {
        $infoBook = Product::where('id', $id)->first();
        $author = $infoBook->author->getOriginal();
        $genre = $infoBook->genre->getOriginal();
        $popularBook = Product::where('watched', '>', 10)->get()->take(10);
        $comments = Comments::where('book_id', $id)->take(10)->get();
        return view('page/book-page', compact('author', 'infoBook', 'genre', 'popularBook', 'comments'));
    }

    public function catalog(Request $request)
    {
        $books = Product::all()->take(30);
        $genre = Ganre::all();

        return view('page/filter-page', ['data' => $books,'genre'=>$genre]);
    }

    public function searchCatalog(Request $request)
    {
        $result = null;
        $data = [
            'filter' => $request->get('filter'),
            'query' => $request->get('query')
        ];
        if ($data['filter'] == "true") {
            $filter = $request->get('filterInfo');
            $minPrice = intval($filter['min-price']) ?? 0;
            $maxPrice = intval($filter['max-price']) ?? 1000;
            $genre = $filter['genre'];
            $author = $filter['author'];
            $sort = $filter['sort'];


            $query = 'select * from "product" where  price >' . $minPrice . ' and price <' . $maxPrice.'and title ilike %'.$data['query'].'%';

            if (!empty($genre) || !empty($author)) {
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

            $query .= 'order by price ' . $sort;

            $result = DB::select($query);

        } else {
            $result = Product::where('title', 'ilike', '%' . $data['query'] . '%')->take(20)->get();
        }


        $view = view('layout/book-card', ['search' => true, 'result' => $result])->render();
        return response()->json([
            'view' => $view
        ]);
    }

    public function actionPage()
    {
        $data = Product::where('action', true)->get();

        return view('page/action', compact('data'));

    }

    public function getNews()
    {
        $news = News::take(20)->get();
        return view('page.news', compact('news'));
    }

    public function addComment(Request $req)
    {
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
            $userInfo = User::where('id', $idUser)->first();
            $commentBody = view('layout/user-comment', ['text' => $comment, 'user' => $userInfo, 'live' => $live])->render();

            return response()->json([
                'commented' => true,
                'body' => $commentBody
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'commented' => false
            ]);
        }
    }

    public function searchShort(Request $req)
    {
        $type = $req->get('type');

        switch ($type) {
            case 'Popular':
                $data = Product::where('watched', '>', 100)->take(20);
                break;
            case 'News':
                $data = new Date();
                dd($data);

                break;
            case 'Action':
                $data = Product::where('action', true)->take(20);
                break;
            case 'Recommended':
                $data = Product::all()->random(20);
                break;
        }
    }

    public function showNews()
    {
        return view('page.news');
    }

    public function profile(Request $req)
    {
        $cook = Cookie::get('auth');
        $user = User::where('token',$cook)->first();
        return view('page.profile-page',compact($user));
    }

    public function changeUserRealInfo(Request $req){
        $user = $req->get('user');
        $firstname = $req->get('firstname');
        $lastname = $req->get('lastname');
        $img = $req->file('avatar');


        if($img == null){
            $user->update([
                'firstname' => $firstname,
                'lastname' =>$lastname,
            ]);
        }else{
            Storage::disk('public')->put('/bookImg',$img);
            $user->update([
                'firstname' => $firstname,
                'lastname' =>$lastname,
                'img' =>$img->hashName()
            ]);
        }


        return back(303)->with('succ','Зміни збережено');

    }

    public function changePassword(Request $req)
    {
        $user = $req->get('user');
        $old = $req->get('old');
        $new = $req->get('new');
        $repeat = $req->get('repeat');

        $old = crc32($old);

        if($user->password != $old){
            return back()->withErrors(['Старий пароль вказано невірно']);
        }else if($new != $repeat){
            return back()->withErrors(['Паролі не співпадають']);
        }else{
            $new = crc32($new);
            $user->update([
                'password'=>$new
            ]);
            return back(303)->with('succ','Пароль змінено');
        }




    }

    public function changeDopInfo(Request $req){
        $user = $req->get('user');
        $phone = $req->get('phone');
        $username = $req->get('username');
        if($username === $user->username){
            if($phone != null){
                $user->update(['phone' => $phone]);
                return back(303)->with('succ','Зміни збережено');
            }
            return back()->withErrors(['Ви вже використовуте вказаний нік']);
        }
        $checkUserName = User::where('username',$username)->first();

        if($checkUserName != null){
            return back()->withErrors(['Нік зайнятий,спробуйте інший']);
        }

        $user->update(['phone' => $phone,'username'=>$username]);

        return back(303)->with('succ','Зміни збережено');

    }

    public function serchHeader(Request $req){
        $query = $req->get('title');
        $book = Product::where('title','like','%'.$query.'%')->take(20)->get();
        $genre = Genre::all();
        return view('page/filter-page',['data'=>$book,'genre'=>$genre,'query'=>$query]);
    }

    public function searchAuthor(Request $req){
            $name = $req->get('name');

            $authors = Author::where('name','like','%'.$name.'%')->take(10)->get();
//            dd($authors);
            $view  = view('layout.author-search',['data'=>$authors])->render();

            return response()->json([
                'view'=>$view
            ]);


    }
}
