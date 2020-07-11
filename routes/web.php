<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

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

Route::post('/like', ['as' => 'pertanyaan.like', 'uses' => 'PertanyaanController@postLike']);

Route::get('/tag', ['as' => 'tag.index', 'uses' => 'TagController@index']);
Route::post('/tag', ['as' => 'tag.store', 'uses' => 'TagController@store']);
Route::get('/tag/{id}', ['as' => 'tag.show', 'uses' => 'TagController@show']);
Route::get('/tag/{id}/edit', ['as' => 'tag.edit', 'uses' => 'TagController@edit']);
Route::post('/tag/{id}', ['as' => 'tag.update', 'uses' => 'TagController@update']);
Route::delete('/tag/{id}', ['as' => 'tag.destroy', 'uses' => 'TagController@destroy']);

Route::get('/profil/{id}/edit', ['as' => 'profil.edit', 'uses' => 'ProfilController@edit']);
Route::put('/profil/{id}/update', ['as' => 'profil.update', 'uses' => 'ProfilController@update']);

Route::post('/jawaban/{id_pertanyaan}', ['as' => 'jawaban.store', 'uses' => 'JawabanController@store']);
