<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {

    Route::post('login', 'UserController@login');
    Route::get('logout', 'UserController@logout');
    Route::post('refresh', 'UserController@refresh');
    Route::post('me', 'UserController@me');
    //logged in user
    Route::get('loggedIn', 'UserController@user');
});




// user images
Route::post('user/cover_image/{id}', 'UserController@updateCover');
Route::get('user/{id}', 'UserController@show');

// friend ship
Route::group(['prefix' => 'user'], function () {
    Route::get('friend_status/{reciever}/{sender}', 'FriendshipController@status' );
    Route::post('addfriend/{reciever}/{sender}', 'FriendshipController@addfriend');
    Route::delete('canclefriend/{reciever}/{sender}', 'FriendshipController@canclefriend');
    Route::post('confirmfriend', 'FriendshipController@confirmfriend');
    Route::post('all_friends', 'FriendshipController@all_friends');
    Route::get('pending_friend/{id}', 'FriendshipController@pending');

});


Route::group(['prefix' => 'user'], function () {
    Route::post('signup', 'UserController@signup');
});





Route::get('/users', 'PostController@getUsers')->middleware('crossorigin');
Route::get('/', 'PostController@index')->name('post.home') ;
Route::get('/json', 'PostController@jsonIndex')->middleware(['crossorigin',  'jwt.auth',]);



Route::get('/comments', 'commentController@index')->name('post.getComments');
Route::get('/reply', 'ReplyController@index')->name('post.reply');


Route::get('/users/{slug}','PostController@show' );

Route::get('/edit/{id}', 'PostController@edit')->name('post.edit');
Route::post('/post/{user}', 'PostController@store')->name('post.post');

Route::post('/update/{id}', 'PostController@update')->name('post.update');

Route::delete('/delete/{id}/{user}', 'PostController@destroy')->name('post.delete');
Route::post('/comment/{id}/{user}', 'commentController@store')->name('post.comment');

Route::post('/reply/{id}/{user}', 'ReplyController@store')->name('post.reply');
Route::put('/likePost/{id}/{user}', 'LikesController@addLike')->name('post.likes');
Route::post('/dislikePost/{id}', 'LikesController@destroy')->name('post.dislikes');



