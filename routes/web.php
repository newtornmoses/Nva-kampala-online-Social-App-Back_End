<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//users
Route::group(['prefix' => 'user'], function() {
    // Route::get('/signup', 'UserController@index')->name('user.signup');
    // Route::post('/signup', 'UserController@registerUser')->name('user.singupPost');
    // Route::get('/logout', 'UserController@logout' )->name('user.logout');
    // Route::get('/login', 'UserController@getLogin')->name('user.getlogin');
  
    //  Route::post('/login', 'UserController@login')->name('user.login');
    // Route::get('/Userprofile', 'UserController@Userprofile')->name('user.profile');
    // Route::get('/Userprofile/{id}', 'UserController@UserprofileId')->name('user.profilebyId');
    Route::post('/signup', 'UserController@registerUser');
    
    
    


});



