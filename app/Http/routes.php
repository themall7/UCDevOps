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
	return View::make('welcome');
});

Route::get('/login', ['uses' => 'UserController@getLogin']);
Route::post('/login', ['uses' => 'UserController@postLogin']);
Route::get('/logout', ['uses' => 'UserController@getLogout']);

Route::group(['middleware' => 'auth'], function()
{
	Route::get('/dashboard', function()
	{
		return View::make('dashboard');
	});

	// Users
	Route::get('/users', ['uses' => 'UserController@getUsers']);
	Route::get('/user/{id?}', ['uses' => 'UserController@getUser']);
	Route::post('/user/{id?}', ['uses' => 'UserController@postUser']);
	Route::get('/user/{id}/delete', ['uses' => 'UserController@deleteUser']);
});


/*Route::group(['prefix' => 'kk'], function () {
    //Route::get('/charts', ['as' => 'charts']);
    Route::get('/charts', ['as' => 'charts', function()
    {
        return View::make('mcharts');
    }]);
});*/
Route::group(['prefix' => 'ui'], function () {
	Route::get('/', function()
	{
		return View::make('home');
	});

});
Route::get('/app', function()
{
	return View::make('app');
});

Route::get('/charts', function()
{
	return View::make('mcharts');
});

Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});


Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::get('/documentation', function()
{
	return View::make('documentation');
});