<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function addBook(Request $request){


        $name = $request->get('nameBook');
        $price = $request->get('nameBook');
        $ganre = $request->get('create-select-ganre');
        $author = $request->get('author');
        $desription = $request->get('description');

        $img = $request->file('bookImg');

        dd($img,$request->hasFile('bookImg'));

        // dd(file_get_contents($img));

    }
}
