<?php

use Illuminate\Http\Request;

Route::group(['prefix' => '/user'], function () {
  Route::get('/profile/{id}', 'UserController@profile');
  Route::get('/list', 'UserController@list');
});
