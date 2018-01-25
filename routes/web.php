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

Route::get('/home', 'AdvertsController@index');

Route::get('/adverts/location/{location}', 'AdvertsController@byLocation');

Route::get('/adverts/{category}', 'AdvertsController@byCategory');

Route::get('/adverts/{category}/{location}', 'AdvertsController@byCategoryLocation');

Route::get('/adverts', 'AdvertsController@adverts');

Route::get('/ads/{id}', 'AdvertsController@byID');

Route::get('/new',[
    'as' => 'new',
    'uses' => 'AdvertsController@new'
])->middleware("admin");

Route::post('/addnew', 'AdvertsController@insert');

Route::post('/adverts/view', 'AdvertsController@view');
