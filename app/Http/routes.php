<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@signin');
Route::get('home', 'IndexController@showIndex');
Route::get('accueil', 'IndexController@showIndex');
Route::get('active/{key}', 'UtilisateursController@activate');
Route::get('account', 'UtilisateursController@show');
Route::get('edit', 'UtilisateursController@edit');
Route::get('delete', 'UtilisateursController@destroy');
Route::get('logout', 'UtilisateursController@logout');
Route::get('ads', 'AnnoncesController@create');
Route::get('allads', 'AnnoncesController@index');
Route::get('show/{id}', 'AnnoncesController@show');
Route::get('edit/{id}', 'AnnoncesController@edit');
Route::get('delete/{id}', 'AnnoncesController@destroy');
Route::get('message', 'MessagesController@index');
Route::get('message/{id}', 'MessagesController@index');
Route::get('conv', 'MessagesController@create');
Route::get('allusers', 'UtilisateursController@allusers');
Route::get('conv/{id}', 'MessagesController@create');
Route::post('store/msg', 'MessagesController@store');
Route::post('message/new/{id}', 'MessagesController@index');
Route::post('addUser', 'UtilisateursController@store');
Route::post('update', 'UtilisateursController@update');
Route::post('login', 'UtilisateursController@authenticate');
Route::post('addAds', 'AnnoncesController@store');
Route::post('update/{id}', 'AnnoncesController@update');
Route::post('search', 'AnnoncesController@search');