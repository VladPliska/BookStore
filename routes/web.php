<?php


Route::post('/addBook','AdminController@addBook');

Route::get('/', 'HomeController@index');

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

Route::get('/order',function(){
    return view('page/order');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/signup',function(){
    return view('page/register');
});
Route::get('/login',function(){
    return view('page/login');
});
Route::get('/user',function(){
    return view('page/user');
});

