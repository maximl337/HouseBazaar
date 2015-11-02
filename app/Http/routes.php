<?php


Route::get('/', 'PagesController@home');



Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::resource('properties', 'PropertyController');

Route::get('{zip}/{street}', 'PropertyController@show');

Route::post('{id}/photos', ['as' => 'store_photo_path', 'uses' => 'PhotoController@store']);

Route::delete('photos/{id}', 'PhotoController@destroy');