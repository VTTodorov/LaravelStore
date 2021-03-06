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
Route::get('/adv/{adv}', 'AdvertsController@byID');
Route::get('/adv/{adv}/edit', 'AdvertsController@edit');

Route::get('/news', 'NewsController@news');
Route::get('/news/{news}', 'NewsController@byID');
Route::get('/news/{news}/edit', 'NewsController@edit');

Route::get('/contact', 'HomeController@contact');


Route::get('/new/advertisment',[
    'as' => 'newAdvertisment',
    'uses' => 'AdvertsController@new'
])->middleware("admin");

Route::get('/new/news',[
    'as' => 'newNews',
    'uses' => 'NewsController@new'
])->middleware("admin");

Route::get('/new/location',[
    'as' => 'newLocation',
    'uses' => 'LocationController@new'
])->middleware("admin");

Route::post('/new/news/insert', 'NewsController@insert');

Route::post('/new/location/insert', 'LocationController@insert');

Route::post('/new/adverts/insert', 'AdvertsController@insert');

Route::post('/adverts/view', 'AdvertsController@view');

Route::post('/adv/{id}/update', 'AdvertsController@update');

Route::post('/news/{news}/update', 'NewsController@update');
