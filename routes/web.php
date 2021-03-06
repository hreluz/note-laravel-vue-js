<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('notes', 'NoteController@index')->name('notes.index')->middleware('auth');
Route::post('notes', 'NoteController@store')->name('notes.store')->middleware('auth');
Route::delete('notes/{id}', 'NoteController@destroy')->name('notes.destroy')->middleware('auth');
Route::put('notes/{id}', 'NoteController@update')->name('notes.update')->middleware('auth');
