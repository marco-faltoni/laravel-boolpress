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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');
Route::get('/categories/{slug}', 'PostController@category')->name('category.show');

Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/posts', 'PostController');

    // route resource sostituisce le rotte sotto, semplifica scrivendo solo una riga. Le scrivo a mano se voglio combiarle.
    // Route::get('/posts', 'PostController@index');
    // Route::get('/posts/create', 'PostController@create');
    // Route::post('/posts', 'PostController@store');
    // Route::get('/posts/{posts}', 'PostController@show');
    // Route::get('/posts/{posts}/edit', 'PostController@edit');
    // Route::put('/posts/{posts}', 'PostController@update');
    // Route::delete('/posts/{posts}', 'PostController@destroy');
});
