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

Route::get('/','MainController@homepage');

Route::prefix('/admin')->middleware('auth')->group(function(){

    Route::get('', 'AdminController@dashboard')->name('admin');

    Route::prefix('/news')->group(function(){

        Route::get('', 'AdminController@news');
        Route::post('/insert', 'AdminController@newsInsert');

        Route::get('/edit/{id}', 'AdminController@editNews');
        Route::post('/update', 'AdminController@updateNews');
        Route::post('/delete', 'AdminController@deleteNews');

    });

    Route::prefix('/kategori-project')->group(function(){

        Route::get('', 'AdminController@kategoriProject');
        Route::post('/insert', 'AdminController@insertKategoriProject');

        Route::get('/edit/{id}', 'AdminController@editKategoriProject');
        Route::post('/update', 'AdminController@updateKategoriProject');
        Route::post('/delete', 'AdminController@deleteKategoriProject');

    });

    Route::prefix('/project')->group(function(){

        Route::get('', 'AdminController@project');
        Route::post('/insert', 'AdminController@insertProject');

        Route::get('/edit/{id}', 'AdminController@editProject');
        Route::post('/update', 'AdminController@updateProject');
        Route::post('/delete', 'AdminController@deleteProject');

    });

});


Auth::routes();

Route::get('/home', 'HomeController@index');
