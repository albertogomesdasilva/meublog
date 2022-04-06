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
        Route::get('/edit-capa/{id}','ArtigoController@editCapa');
        Route::put('/upload-capa/{id}','ArtigoController@uploadCapa');
        Route::post('/delete-capa/{id}','ArtigoController@deleteCapa');
        Route::get('/edit-arquivo/{id}','ArtigoController@editArquivo');
        Route::put('/upload-arquivo/{id}','ArtigoController@uploadArquivo');
        Route::delete('/delete-arquivo/{id}','ArtigoController@deleteArquivo');            
    });  

    Route::prefix('tema')->name('tema.')->group(function(){
        Route::get('/index','TemaController@index')->name('index');
        Route::post('/store','TemaController@store');
        Route::get('/edit/{id}','TemaController@edit');
        Route::put('/update/{id}','TemaController@update');
        Route::delete('/delete/{id}','TemaController@destroy');
      }); 
    
}); //representa o fechamento do grupo admin


Route::namespace('App\Http\Controllers\Page')->name('page.')->group(function(){
    Route::get('/','HomeController@master')->name('master');
    Route::get('/artigo/{slug}','HomeController@detail')->name('detail');
    Route::get('/download-arquivo/{id}','HomeController@downloadArquivo')->name('download');
    Route::get('/tema/{slug}','TemaArtigoController@index')->name('tema');
  });
  

