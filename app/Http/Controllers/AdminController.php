<?php

namespace App\Http\Controllers;

use App\models\Coments as Comments;
use App\models\Ganre;
use App\models\News;
use App\models\User;
use App\models\Order;
use Illuminate\Http\Request;
use App\models\Product as Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\models\Author;

class AdminController extends Controller
{


    function addBook(Request $request)
    {
//        dd($request->file('image'));
        $name = $request->get('nameBook');
        $price = $request->get('price');
        $ganre = $request->get('create-select-ganre');
        $author = $request->get('authorName');
        $desription = $request->get('description');
        $id = $request->get('type');
        $img = $request->file('image');
        $action = $request->get('action-price');

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

        if ($id == null) {

            $path = $request->file('image')->store('images', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');
            $authorData = Author::where('id', $author)->first();

            $authorData->update(['books' => $authorData->books + 1]);

            Product::create([
                'title' => $name,
                'description' => $desription,
                'price' => $price,
                'img' => Storage::disk('s3')->url($path),
                'genre_id' => $ganre,
                'author_id' => $author,
                'action' => $action ?? 0
            ]);

            return back();
        } else {
            $product = Product::where('id', $id)->first();

            if ($img == null) {
                $product->update([
                    'title' => $name,
                    'description' => $desription,
                    'price' => $price,
                    'genre_id' => $ganre,
                    'author_id' => $author,
                    'action' => $action ?? 0
                ]);
                if ($product->author_id != $author) {
                    $authorData = Author::where('id', $author)->first();

                    $authorData->update(['books' => $authorData->books + 1]);
                }
            } else {
                $path = $request->file('image')->store('images', 's3');

                Storage::disk('s3')->setVisibility($path, 'public');

                if ($product->author_id != $author) {
                    $authorData = Author::where('id', $author)->first();

                    $authorData->update(['books' => $authorData->books + 1]);
                }

                $product->update([
                    'title' => $name,
                    'description' => $desription,
                    'price' => $price,
                    'img' => Storage::disk('s3')->url($path),
                    'genre_id' => $ganre,
                    'author_id' => $author,
                    'action' => $action ?? 0
                ]);
            }
            return back();


        }

    }

    function index()
    {
        $users = User::count();
        $books = Product::count();
//     $club= User::where('club',true)->count();
        $club = 100;
        $profit = 0;
        $orderData = Order::all();
        foreach ($orderData as $v) {
            $profit += $v->price;
        }
        $orderMonth = Order::where(
            'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString()
        )->get();
        $monthProfit = 0;
        foreach ($orderMonth as $v) {
            $monthProfit += $v->price;
        }
        $orders = Order::count();
        $comments = Comments::count();
        $genre = Ganre::all();
        return view('page.index-admin', compact('users', 'books', 'club', 'profit',
            'orders', 'monthProfit', 'comments', 'genre'));

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
                $data = Product::take(20)->orderBy('id', 'desc')->get();
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
        $created = date('Y/m/d h:i:s', time());
        $updated = date('Y/m/d h:i:s', time());
        try {
            News::create([
                'text' => $text,
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

    public function addAuthor(Request $req)
    {
        $text = $req->get('text');
        try {
            Author::create([
                'name' => $text,
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

    public function getBookInfo(Request $req)
    {
        $id = $req->get('id');

        $product = Product::where('id', $id)->first();
        $product->authorname = $product->author->name;
        return response()->json([
            'info' => $product
        ]);
    }


    public function deleteBook(Request $req)
    {
        $id = $req->get('id');
        $type = $req->get('type');

        if ($type == 'book') {
            $delete = Product::where('id', $id)->first();
            $author = Author::where('id', $delete->author_id)->first();
            if ($author->books > 0) {
                $author->update(['books' => intval($author->books) - 1]);
            }
        } else {
            $delete = Comments::where('id', $id)->first();
        }


        if ($delete) {
            $delete->delete();
            return response()->json([
                'delete' => true
            ]);
        } else {
            return response()->json([
                'delete' => false
            ]);
        }
    }

    public function getAllOrders(Request $req)
    {
        $orders = Order::all()->take(20);

        $view = view('.layout.order-item', compact('orders'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function getOrder(Request $req)
    {
        $id = $req->get('id');

        $order = Order::where('id', $id)->first();
        $countInfo = json_decode($order->orderInfo);
        $bookId = [];
        foreach ($countInfo as $v) {
            array_push($bookId, $v->id);
        }
        $books = Product::whereIn('id', $bookId)->get();

        $info = $this->setCountOrder($books, $countInfo);
        $view = view('.layout.order-select-item', ['data' => $info])->render();
        return response()->json([
            'order' => $order,
            'view' => $view
        ]);
    }

    function setCountOrder($books, $countInfo)
    {
        foreach ($books as $v) {
            foreach ($countInfo as $val) {
                if ($v->id == $val->id) {
                    $v->count = $val->count;

                }
            }
        }
        return $books;
    }

    public function changeSatus(Request $req)
    {
        $id = $req->get('id');
        $status = $req->get('status');

        $order = Order::where('id', $id)->first();
        $order->update(['status' => $status]);

        return response()->json([
            'success' => true
        ]);

    }

    public function getAuthors(Request $req)
    {
        $author = Author::where('id', '>', 0)->orderBy('id', 'asc')->get();

        $view = view('.layout.order-item', ['data' => $author, 'author' => true])->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function changeAuthor(Request $req)
    {

        $author = Author::where('id', $req->get('id'))->first();
        try {
            if ($req->get('delete') == 'true') {
                if ($author->books > 0) {
                    return response()->json([
                        'change' => false,
                        'message' => 'Автор не можу бути видалений так як він має книги'
                    ]);
                } else {
                    $author->delete();

                }
            } else if ($req->get('delete') == 'false') {
                $author->update(['name' => $req->get('name')]);
            }
            return response()->json([
                'change' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'change' => false
            ]);
        }
    }

    public function searchAdmin(Request $req)
    {
        $query = $req->get('text');
        $table = $req->get('search');

        switch ($table) {
            case 'book':
                $data = Product::where('title', 'ilike', '%' . $query . '%')->get();
                $view = view('page.admin.book-list', ['books' => $data])->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
            case 'author':
                $data = Author::where('name', 'ilike', '%' . $query . '%')->get();
                $view = view('.layout.order-item', ['data' => $data, 'author' => true])->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
                break;
            case 'order':
                $data = Order::where('firstname', 'ilike', '%' . $query . '%')->orWhere('lastname', 'ilike', '%' . $query . '%')->get();
                $view = view('.layout.order-item', ['orders' => $data])->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
            case 'comment':
                $data = Comments::where('coment', 'ilike', '%' . $query . '%')->get();
                $view = view('page.admin.comments-list', compact('data'))->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
            case 'user':
                $data = User::where('username', 'ilike', '%' . $query . '%')->orWhere('email', 'ilike', '%' . $query . '%')->get();
                $view = view('page.admin.users-list', compact('data'))->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
        }


    }


}
