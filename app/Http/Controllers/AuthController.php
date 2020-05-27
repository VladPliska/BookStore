<?php

namespace App\Http\Controllers;

use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function signup(Request $req){
        $username = $req->get('username');
        $email = $req->get('email');
        $pass = $req->get('pass');

        $password = crc32($pass);

        try {
            User::create([
                'username'=>$username,
                'email'=>$email,
                'password'=>$password,
                'role'=>'user'
            ]);
        }catch (\Exception $e){
            if($e->getCode() == 23505){
                return back()->withErrors(['Email зайнятий,спробуйте інший']);
            }
        }

        return redirect('/profile');

    }


    public function login(Request $req){
        $login = $req->get('username');
        $password = $req->get('password');
        $cook = Cookie::get('auth');

//        if($cook){
//            $data = User::where('token',$cook)->first();
//            $data->update(['token','']);
//            Cookie::unqueue('auth');
//        }
        $pass = crc32($password);

//        dd($login,$pass);
        $user = User::where([
            'username'=>$login,
            'password'=>$pass,
        ])->whereOr([
            'email'=>$login,
            'password'=>$pass,
        ])->first();

            if($user != null){
            $token = hash('md5',rand(2,200));
            $user->update(['token'=>$token]);
            Cookie::queue('auth',$token,60*30);
            return redirect('profile',302);
        }else{
            return back()->with(['err'=>'Неправильний логін або пароль']);
        }
    }


    public function logout(Request $req){
            $cook = Cookie::get('auth');
            try{
                $user = User::where('token',$cook)->first();
                $user->update(['token'=>null]);
                Cookie::unqueue('auth');
                return response()->json([
                        'logout'=>true
                ]);
            }catch (\Exception $e){
            return response()->json([
                'logout'=>false
            ]);
        }




    }
}
