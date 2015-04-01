<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/home', function()
{
    return View::make('home');
});


Route::get('/daqinv', 'HomeController@index');
Route::get('/daqinv/lists/{categories}', 'HomeController@lists');



Route::post('/home', array(
    'as' => 'post-sign-in',
    'uses' => 'ProfileController@signIn'
));

Route::get('/logout', function(){
    Auth::logout();
    return View::make('logout');
});

Route::get('/restricted', array('before' => 'auth', function(){
    return View::make('restricted'); }

));


Route::get('/restricted2', array('before' => 'auth', function(){
    return View::make('restricted2'); }

));

//
//Route::group(array('before' => 'guest', function(){
//    //Unauthenticated guests
//    Route::group(array('before' => 'crsf', function(){
//        return "";
//
//    }));
//    return "";
//}));
