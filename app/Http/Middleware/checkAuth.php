<?php

namespace App\Http\Middleware;

use Closure;
use App\models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class checkAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cook = Cookie::get('auth');
        $countBook = $_COOKIE['basket'] ?? [];

        if(!empty($countBook)){
            $countId = explode(',', $countBook);
            $count = count($countId);
        }else{
            $count = 0;
        }

        View::share('countBook',$count);

        if ($cook) {
            $user = User::where('token', $cook)->first();

            if ($user != null) {
                View::share('user', $user);
                $request->request->add(['user' => $user]);
                if ($user->role != 'admin' && $request->path() == 'admin') {
                    return redirect('/login');
                }
            } else {
                View::share('user', null);
                $request->request->add(['user' => null]);
                if ($request->path() == 'profile' || $request->path() == 'admin') {
                    return redirect('/login', 302);
                }
            }
        } else {
            View::share('user', null);
            $request->request->add(['user' => null]);
        }
        return $next($request);
    }
}
