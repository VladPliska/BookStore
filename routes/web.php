<?php

////Auth /////
Route::post('/signup','AuthController@signup')->name('register');
Route::get('/confirmation/{token}','AuthController@confirm');
Route::post('/login','AuthController@login');
Route::get('/logout','AuthController@logout');
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

    Route::put('/addNews','AdminController@addNews');

    Route::get('/profile','HomeController@profile');

    Route::get('/news','HomeController@showNews');

    Route::post('/changeDopInfo','HomeController@changeDopInfo');

    Route::post('/changePass','HomeController@changePassword');

    Route::post('/changeUserRealInfo','HomeController@changeUserRealInfo');

    Route::post('/ban','AdminController@banUser');
});



//////////////////Route for test
Route::get('/book',function(){
    return view('page/book-page');
});

Route::get('/buy',function(){
    return view('page/basket');
});



Route::get('/order',function(){
    return view('page/order');
});


Route::get('/user',function(){
    return view('page/user');
});

