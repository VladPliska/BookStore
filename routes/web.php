<?php


////Auth /////
Route::post('/signin','AuthController@signin');
Route::get('/confirmation/{token}','AuthController@confirm');
Route::post('/login','AuthController@login');
///////////////
///
///

Route::group(['middleware' => ['user']], function () {
    Route::get('/', 'HomeController@index');

    Route::post('/addBook','AdminController@addBook');

    Route::get('/book/{id}','HomeController@getBook');

    Route::get('/catalog','HomeController@catalog');

    Route::post('/searchCatalog','HomeController@searchCatalog');

    Route::get('/action','HomeController@actionPage');

    Route::get('/admin','AdminController@index');

    Route::post('/getAdminInfo','AdminController@getInfo');
});




//////////////////Route for test
Route::get('/book',function(){
    return view('page/book-page');
});

Route::get('/buy',function(){
    return view('page/basket');
});


Route::get('/profile',function(){
    return view('page/profile-page');
});
//Route::get('/admin',function(){
//    return view('page/index-admin');
//});

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

