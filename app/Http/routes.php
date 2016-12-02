<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/logout', 'Auth\AuthController@getLogout');


Route::get('/home', 'HomeController@index');
Route::get('/{username}', ['as' => 'my_profile', 'uses' => 'UserController@profile']);
Route::get('/{username}/dashboard', ['as' => 'my_dashboard', 'uses' => 'UserController@dashboard']);
Route::get('/{username}/new-project', ['as' => 'create_project', 'uses' => 'UserController@create_project']);
Route::post('/save-project', ['as' => 'save_project', 'uses' => 'UserController@save_project']);
Route::get('/{username}/{project_name}', ['as' => 'view_project', 'uses' => 'UserController@view_project'])->middleware('auth');
Route::get('/{username}/{project_name}/edit', ['as' => 'edit_project', 'uses' => 'UserController@edit_project']);
Route::post('/update', ['as' => 'update_project', 'uses' => 'UserController@update_project']);
