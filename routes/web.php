<?php


Route::get('/', function () {
    return view('page/home');
});

Route::get('/book',function(){
    return view('page/book-page');
});

Route::get('/buy',function(){
    return view('page/basket');
});

Route::get('/catalog',function(){
    return view('page/filter-page');
});
Route::get('/profile',function(){
    return view('page/profile-page');
});
Route::get('/admin',function(){
    return view('page/index-admin');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/signup',function(){
    return view('page/register');
});