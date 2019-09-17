<?php

use Illuminate\Http\Request;

Route::group(['prefix' => '/user'], function () {
  Route::get('/profile/{id}', 'UserController@profile');
  Route::get('/list', 'UserController@list');
  Route::post('/add', 'UserController@add');
  Route::post('/edit', 'UserController@edit');
});

Route::group(['prefix' => '/product'], function () {
  Route::get('/list', 'ProductController@list');
  Route::post('/add', 'ProductController@add');
  Route::post('/edit', 'ProductController@edit');
});

Route::group(['prefix' => '/order'], function () {
  Route::get('/list', 'OrderController@list');
  Route::post('/add', 'OrderController@add');
  Route::post('/edit', 'OrderController@edit');
});
