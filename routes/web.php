<?php


use Illuminate\Support\Facades\Route;

// Login/Logout/register routes
Auth::routes();

// Casual route for landing page
Route::get('/home', 'HomeController@index')->name('/home');
Route::get('/', 'HomeController@index')->name('/');

// Route related to post gestion (only accessible to people that are defined as publisher)
Route::group(['middleware' => ['App\Http\Middleware\Publisher'], 'prefix' => 'posts'], function() {

    Route::get('/new', 'PostController@create');
    Route::post('/new', 'PostController@store');
    Route::get('/{id}/edit', 'PostController@edit');
    Route::post('/{id}', 'PostController@update');
    Route::delete('/{id}', 'PostController@destroy');

});

// Route display a post
Route::get('/posts/{id}', 'PostController@show');

// Route related to comments
Route::group(['middleware' => ['auth'], 'prefix' => 'comments'], function() {

    Route::post('/new', 'CommentController@create');
    Route::post('/{id}', 'CommentController@update');
    Route::delete('/{id}', 'CommentController@destroy');

});

// Route that return an image from the laravel Storage
Route::get('/image/{filename}', 'HomeController@displayImage')->name('image.displayImage');
Route::get('/avatar/{filename}', 'HomeController@displayAvatar')->name('image.displayAvatar');

// Route related to user profile
Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function() {

    Route::get('/', 'ProfileController@index');
    Route::get('/edit/', 'ProfileController@edit');
    Route::post('/update', 'ProfileController@update');
    Route::post('/avatar', 'ProfileController@avatar_change');

});

Route::group(['prefix' => 'user'], function() {
    Route::get('/name/{id}', function ($id) {
        return \App\Models\User::where('id', $id)->select('name')->first();
    });
});

Route::get('test', function () {
   return view('test');
});
