<?php

////Auth /////
Route::post('/signup','AuthController@signup')->name('register');
Route::get('/confirmation/{token}','AuthController@confirm');
Route::post('/login','AuthController@login');
Route::post('/logout','AuthController@logout');
///////////////

Route::group(['middleware' => ['user']], function () {

    Route::get('/login',function(){
        return view('page/login');
    });

    Route::get('/signup',function(){
        return view('page/register');
    });


    Route::get('/', 'HomeController@index');

    Route::post('/addBook','AdminController@addBook');

    Route::get('/book/{id}','HomeController@getBook');

    Route::get('/catalog','HomeController@catalog');

    Route::post('/searchCatalog','HomeController@searchCatalog');

    Route::get('/action','HomeController@actionPage');

    Route::get('/admin','AdminController@index');

    Route::post('/getAdminInfo','AdminController@getInfo');

    Route::post('/addComment','HomeController@addComment');

    Route::post('/addNews','AdminController@addNews');

    Route::post('/addAuthor','AdminController@addAuthor');

    Route::get('/profile','HomeController@profile');

    Route::get('/news','HomeController@showNews');

    Route::post('/changeDopInfo','HomeController@changeDopInfo');

    Route::post('/changePass','HomeController@changePassword');

    Route::post('/changeUserRealInfo','HomeController@changeUserRealInfo');

    Route::post('/ban','AdminController@banUser');

    Route::get('/headerSearch','HomeController@serchHeader');

    Route::post('/bookInfo','AdminController@getBookInfo');

    Route::delete('/deleteBook','AdminController@deleteBook');

    Route::get('/buy','HomeController@getBuyContent');

    Route::get('/book',function(){
        return view('page/book-page');
    });
    Route::get('/order','HomeController@orderPage');

    Route::post('/createOrder','HomeController@createOrder');

    Route::post('/searchAdmin','AdminController@searchAdmin');



});

Route::post('/getAllOrders','AdminController@getAllOrders');

Route::post('/getOrder','AdminController@getOrder');

Route::post('/changeStatus','AdminController@changeSatus');

Route::post('/searchAuthor','HomeController@searchAuthor');

Route::post('/getAuthors','AdminController@getAuthors');

Route::post('/changeAuthor','AdminController@changeAuthor');


//////////////////Route for test







Route::get('/user',function(){
    return view('page/user');
});

