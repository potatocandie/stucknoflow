<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['as' => 'pages.index', 'uses' => 'PagesController@index']);
Route::get('/about', ['as' => 'pages.about', 'uses' => 'PagesController@about']);
Route::get('/show/{id}', ['as' => 'pages.show', 'uses' => 'PagesController@show']);

Auth::routes();

Route::get('/pertanyaan', ['as' => 'pertanyaan.index', 'uses' => 'PertanyaanController@index']);
Route::get('/pertanyaan/create', ['as' => 'pertanyaan.create', 'uses' => 'PertanyaanController@create']);
Route::post('/pertanyaan/store', ['as' => 'pertanyaan.store', 'uses' => 'PertanyaanController@store']);
Route::get('/pertanyaan/{id}/edit', ['as' => 'pertanyaan.edit', 'uses' => 'PertanyaanController@edit']);
Route::put('/pertanyaan/{id}/update', ['as' => 'pertanyaan.update', 'uses' => 'PertanyaanController@update']);
Route::get('/pertanyaan/{id}/show', ['as' => 'pertanyaan.show', 'uses' => 'PertanyaanController@show']);
Route::delete('/pertanyaan/{id}/destroy', ['as' => 'pertanyaan.destroy', 'uses' => 'PertanyaanController@destroy']);

Route::get('/tag', ['as' => 'tag.index', 'uses' => 'TagController@index']);
Route::post('/tag', ['as' => 'tag.store', 'uses' => 'TagController@store']);
Route::get('/tag/{id}', ['as' => 'tag.show', 'uses' => 'TagController@show']);
Route::get('/tag/{id}/edit', ['as' => 'tag.edit', 'uses' => 'TagController@edit']);
Route::post('/tag/{id}', ['as' => 'tag.update', 'uses' => 'TagController@update']);
Route::delete('/tag/{id}', ['as' => 'tag.destroy', 'uses' => 'TagController@destroy']);
