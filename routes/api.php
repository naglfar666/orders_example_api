<?php

use Illuminate\Http\Request;

Route::group(['prefix' => '/user'], function () {
  Route::get('/single/{id}', 'UserController@single');
  Route::get('/list', 'UserController@list');
  Route::post('/add', 'UserController@add');
  Route::post('/edit', 'UserController@edit');
});

Route::group(['prefix' => '/product'], function () {
  Route::get('/single/{id}', 'ProductController@single');
  Route::get('/list', 'ProductController@list');
  Route::post('/add', 'ProductController@add');
  Route::post('/edit', 'ProductController@edit');
});

Route::group(['prefix' => '/order'], function () {
  Route::get('/single/{id}', 'OrderController@single');
  Route::get('/list', 'OrderController@list');
  Route::post('/add', 'OrderController@add');
  Route::post('/edit', 'OrderController@edit');
});
