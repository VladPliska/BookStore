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

Route
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
