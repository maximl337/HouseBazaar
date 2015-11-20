<?php


Route::get('/', 'PropertyController@index');

Route::get('/browse', 'PropertyController@browse');

Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::post('{id}/photos', ['as' => 'store_photo_path', 'uses' => 'PhotoController@store']);

Route::delete('photos/{id}', 'PhotoController@destroy');

Route::get('preview/{id}', 'PropertyController@preview');

Route::post('properties/{id}/publish', 'PropertyController@publish');

Route::post('properties/{id}', 'PropertyController@update');

Route::get('user/properties', 'PropertyController@myProperties');

Route::resource('properties', 'PropertyController');

Route::post('message', 'MessageController@store');

Route::get('{country}/{zip}/{street}', 'PropertyController@show');

