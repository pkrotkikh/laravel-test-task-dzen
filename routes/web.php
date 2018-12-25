<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();

Route::get('/', ['uses'=>'HomeController@index', 'as'=>'index']);
Route::get('/refresh_captcha', ['uses'=>'HomeController@refreshCaptcha', 'as'=>'refresh.captcha']);

Route::post('/create/article', ['uses'=>'HomeController@create', 'as'=>'article.create']);
Route::post('/show_attachment', ['uses'=>'HomeController@show_attachment', 'as'=>'article.show_attachment']);

Route::get('/{order_by}/{order_type}', ['uses'=>'HomeController@articleSorter', 'as'=>'index.article.sorter']);
