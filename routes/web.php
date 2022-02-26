<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('hello-world', 'App\Http\Controllers\HelloWorldController@index');

//Route::resource('/users', 'App\Http\Controllers\UserController');

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin.')->group(function(){
    Route::prefix('artigos')->name('artigos.')->group(function(){
        Route::get('/index','ArtigoController@index')->name('index');         
        Route::get('/create','ArtigoController@create')->name('create');
        Route::post('/store','ArtigoController@store')->name('store');
        Route::get('/edit/{id}','ArtigoController@edit')->name('edit');
        Route::put('/update/{id}','ArtigoController@update')->name('update');
        Route::delete('/delete/{id}','ArtigoController@destroy')->name('delete');
    });  
    
});

