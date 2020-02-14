<?php

Route::get('/', 'HomeController@index');

Route::post('/addBook','AdminController@addBook');

Route::get('/book/{id}','HomeController@getBook');

Route::post('/signin','AuthController@signin');

//////////////////Route for test
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
Route::get('/signup',function(){
    return view('page/register');
});
Route::get('/login',function(){
    return view('page/login');
});
Route::get('/user',function(){
    return view('page/user');
});

