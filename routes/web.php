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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function () {
	Route::get('/facture/getData/{id}', 'FactureController@client');
	//Route::get('/facture/create', 'FactureController@create');
	Route::post('/facture/save', 'FactureController@postCreate');
	Route::post('/facture/edit', 'FactureController@update');
	Route::get('/facture/pdf/{id}', 'FactureController@pdf');



	Route::resource('facture', 'FactureController',
                 ['expect' => ['create']]);
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::resource('client', 'ClientController',
                 ['only' => ['index']]);

Route::resource('client', 'ClientController',
                 ['expect' => ['create','store']]);

Route::resource('facture', 'FactureController',
                 ['only' => ['index']]);

/**/


