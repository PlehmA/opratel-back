<?php

Route::post('add/user', 'UserController@addUser');
Route::delete('delete/user/{id}', 'UserController@delUser');
Route::get('get/users', 'UserController@getUsers');
Route::put('update/user/{id}', 'UserController@updateUser');
Route::get('get/user/{id}', 'UserController@findUser');