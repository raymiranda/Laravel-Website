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
use App\User;

Route::get('/', function()
{
	return 'Welcome';
});

Route::get('user', function()
{
    return view('users');
});

Route::get('newUser', function()
{
    return 'Your information has been submitted!';
});

Route::post('auth/store', 'Auth\AuthController@store');

Route::post('login', function()
{
    return User::all();
});

//Form routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::controllers([
   'password' => 'Auth\PasswordController',
]);