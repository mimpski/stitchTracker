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
Route::get('/find-friends', 'UserController@find_friends');
Route::get('/follow/{id}', 'UserController@add_following');
Route::get('/unfollow/{id}', 'UserController@remove_following');
Route::get('/{username}', ['as' => 'my_profile', 'uses' => 'UserController@profile']);
Route::get('/{username}/dashboard', ['as' => 'my_dashboard', 'uses' => 'UserController@dashboard']);
Route::get('/{username}/new-project', ['as' => 'create_project', 'uses' => 'ProjectController@create_project']);
Route::post('/save-project', ['as' => 'save_project', 'uses' => 'ProjectController@save_project']);
Route::get('/{username}/{project_name}', ['as' => 'view_project', 'uses' => 'ProjectController@view_project'])->middleware('auth');
Route::get('/{username}/{project_name}/edit', ['as' => 'edit_project', 'uses' => 'ProjectController@edit_project']);
Route::get('/{username}/{project_name}/updates', ['as' => 'add_update', 'uses' => 'ProjectController@add_update']);
Route::post('/updates', ['as' => 'save_to_project', 'uses' => 'ImageController@store']);
Route::post('/update', ['as' => 'update_project', 'uses' => 'ProjectController@update_project']);
