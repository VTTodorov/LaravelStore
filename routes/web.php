<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function (){
    return redirect('/home');
});

Route::get('/home', 'AdvertsController@index')->name('home');

Route::get('/home/{category}', 'AdvertsController@index');

Route::get('/home/ads/{id}', 'AdvertsController@byID');

Route::get('/new','AdvertsController@new');

Route::post('/addnew', 'AdvertsController@insert');
