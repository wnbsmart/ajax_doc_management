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

Auth::routes();

Route::get('/home', 'DocumentController@index')->name('home');
Route::post('/upload', 'DocumentController@store')->name('upload');
Route::post('/show/{id}', 'DocumentController@show')->name('show_file');
Route::delete('/delete/{id}', 'DocumentController@destroy')->name('delete_file');
Route::post('/edit/{id}', 'DocumentController@edit')->name('edit_file');