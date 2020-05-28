<?php

namespace App\Http\Controllers;

use App\models\Author;
use App\models\Coments as Comments;
use App\models\Ganre;
use App\models\Order;
use App\models\Product as Product;
use App\models\User;
use App\models\News as News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function index()
    {
        $popularBook = Product::where('watched', '>', 0)->get()->take(10);

        $actionBook = Product::where('action', '>', 0)->take(20)->get();
        $news = News::take(20)->get();
        return view('page/home', compact('popularBook', 'actionBook', 'news'));
    }

    public function getBook(Request $request, $id)
    {
        $infoBook = Product::where('id', $id)->first();
        $infoBook->update(['watched', $infoBook->watched++]);
        $author = $infoBook->author->getOriginal();
        $genre = $infoBook->genre->getOriginal();
        $popularBook = Product::where('watched', '>', 10)->get()->take(10);
        $comments = Comments::where('book_id', $id)->take(10)->get();
        return view('page/book-page', compact('author', 'infoBook', 'genre', 'popularBook', 'comments'));
    }

    public function catalog(Request $request)
    {
        $books = Product::all();
        $genre = Ganre::all();

        return view('page/filter-page', ['data' => $books, 'genre' => $genre]);
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


            $query = "select * from \"product\" where  price > " . $minPrice . " and price < " . $maxPrice . " and title ilike '%" . $data['query'] . "%'";

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
//            dd($request->all());

            $query .= ' order by price ' . $sort;
//                dd($query);
            $result = DB::select($query);
//            dd($result);
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
        $data = Product::where('action', '>', 1)->get();

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

            Comments::create([
                'user_id' => intval($idUser->id),
                'book_id' => intval($idBook),
                'coment' => $comment
            ]);
            $userInfo = User::where('id', $idUser->id)->first();
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
        $news = News::take(20)->get();
        return view('page.news', compact('news'));
    }

    public function profile(Request $req)
    {
        $cook = Cookie::get('auth');
        $user = User::where('token', $cook)->first();
        return view('page.profile-page', compact($user));
    }

    public function changeUserRealInfo(Request $req)
    {
        $user = $req->get('user');
        $firstname = $req->get('firstname');
        $lastname = $req->get('lastname');
        $img = $req->file('avatar');


        if ($img == null) {
            $user->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
            ]);
        } else {
            Storage::disk('public')->put('/bookImg', $img);
            dd($img);
            $user->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'img' => $img->hashName()
            ]);
        }


        return back(303)->with('succ', 'Зміни збережено');

    }

    public function changePassword(Request $req)
    {
        $user = $req->get('user');
        $old = $req->get('old');
        $new = $req->get('new');
        $repeat = $req->get('repeat');

        $old = crc32($old);

        if ($user->password != $old) {
            return back()->withErrors(['Старий пароль вказано невірно']);
        } else if ($new != $repeat) {
            return back()->withErrors(['Паролі не співпадають']);
        } else {
            $new = crc32($new);
            $user->update([
                'password' => $new
            ]);
            return back(303)->with('succ', 'Пароль змінено');
        }


    }

    public function changeDopInfo(Request $req)
    {
        $user = $req->get('user');
        $phone = $req->get('phone');
        $username = $req->get('username');
        if ($username === $user->username) {
            if ($phone != null) {
                $user->update(['phone' => $phone]);
                return back(303)->with('succ', 'Зміни збережено');
            }
            return back()->withErrors(['Ви вже використовуте вказаний нік']);
        }
        $checkUserName = User::where('username', $username)->first();

        if ($checkUserName != null) {
            return back()->withErrors(['Нік зайнятий,спробуйте інший']);
        }

        $user->update(['phone' => $phone, 'username' => $username]);

        return back(303)->with('succ', 'Зміни збережено');

    }

    public function serchHeader(Request $req)
    {
        $query = $req->get('title');
        $book = Product::where('title', 'like', '%' . $query . '%')->take(20)->get();
        $genre = Genre::all();
        return view('page/filter-page', ['data' => $book, 'genre' => $genre, 'query' => $query]);
    }

    public function searchAuthor(Request $req)
    {
        $name = $req->get('name');

        $authors = Author::where('name', 'like', '%' . $name . '%')->take(10)->get();
//            dd($authors);
        $view = view('layout.author-search', ['data' => $authors])->render();

        return response()->json([
            'view' => $view
        ]);


    }

    public function getBuyContent(Request $req)
    {
        $id = $_COOKIE['basket'] ?? [];
        if (!empty($id)) {
            $id = explode(',', $id);
            $books = Product::whereIn('id', $id)->get();
            return view('page.basket', compact('books'));
        }
        $books = [];
        return view('page.basket', compact('books'));
    }

    public function orderPage(Request $req)
    {
        $id = $req->get('bookId');
        $count = $req->get('count');
        $books = Product::whereIn('id', $id)->get();
        $countInfo = json_decode($_COOKIE['basketNew']);
        $allPrice = 0;
        foreach ($books as $v) {
            foreach ($countInfo as $val) {
                if ($v->id == $val->id) {
                    $v->count = $val->count;
                    $allPrice += $v->price * $v->count;
                }
            }
        }
        return view('page.order', compact('books', 'count', 'allPrice'));
    }

    public function createOrder(Request $req)
    {
        $firstname = $req->get('name');
        $lastname = $req->get('surname');
        $phone = $req->get('number');
        $email = $req->get('email');
        $city = $req->get('city');
        $orderInfo = $_COOKIE['basketNew'];
        $typePay = $req->get('type-pay');
        $post = $req->get('post');
        $user = $req->get('user');
        $allPrice = $req->get('allPrice');
//        dd($req->all(), $orderInfo);

      $order = Order::create([
            'user_id' => $user->id ?? 0,
            'price' => $allPrice,
            'orderInfo' => $orderInfo,
            'phone' => $phone,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'city' =>$city,
            'email'=>$email,
            'post'=>$post,
            'payType'=>$typePay,
            'status'=>'Обробка'
        ]);
//        $_COOKIE['basketNew'] = '';
//        $_COOKIE['basket'] = '';
        setcookie('basketNew', null, -1, '/');
        setcookie('basket', null, -1, '/');

        return redirect('/#createOrder');
    }



}
