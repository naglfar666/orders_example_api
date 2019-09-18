<?php

use Illuminate\Http\Request;

Route::options('{any}')->middleware('cors')->where('any', '.+');

Route::group(['prefix' => '/user', 'middleware' => 'cors'], function () {
  Route::get('/single/{id}', 'UserController@single');
  Route::get('/list', 'UserController@list');
  Route::post('/add', 'UserController@add');
  Route::post('/edit', 'UserController@edit');
  Route::get('/delete/{id}', 'UserController@delete');
});

Route::group(['prefix' => '/product', 'middleware' => 'cors'], function () {
  Route::get('/single/{id}', 'ProductController@single');
  Route::get('/list', 'ProductController@list');
  Route::post('/add', 'ProductController@add');
  Route::post('/edit', 'ProductController@edit');
  Route::get('/delete/{id}', 'ProductController@delete');
});

Route::group(['prefix' => '/order', 'middleware' => 'cors'], function () {
  Route::get('/single/{id}', 'OrderController@single');
  Route::get('/list', 'OrderController@list');
  Route::post('/add', 'OrderController@add');
  Route::post('/edit', 'OrderController@edit');
  Route::get('/delete/{id}', 'OrderController@delete');
});
