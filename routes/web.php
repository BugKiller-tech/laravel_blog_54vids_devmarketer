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

//blog routes, for the users
Route::get('blog', ['as'=>'blog.index', 'uses'=>'BlogController@getIndex']);
Route::get('blog/{slug}', ['as'=>'blog.single', 'uses'=>'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog/cats/{id}', ['as'=>'blog.category_posts', 'uses'=>'BlogController@getPostsinCategory']);




//main page navigation routes
Route::get('/', 'PagesController@getIndex');
Route::get('/about', 'PagesController@getAbout');
Route::get('/contact', 'PagesController@getContact');
Route::post('/contact', 'PagesController@postContact');

//posts routes
Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController', ['except'=>['create']]);

Route::resource('tags', 'TagController', ['except'=>['create']]);


//comment
Route::post('comments/{post_id}', 'CommentsController@store')->name('comments.store');
Route::get('comments/{id}/edit', ['uses'=>'CommentsController@edit', 'as'=>'comments.edit']);
Route::put('comments/{id}', ['uses'=>'CommentsController@update', 'as'=>'comments.update']);
Route::delete('comments/{id}', ['uses'=>'CommentsController@destroy', 'as'=>'comments.destroy']);
Route::get('comments/{id}/delete', ['uses'=>'CommentsController@delete', 'as'=>'comments.delete']);


//authentication routes
Auth::routes();
Route::get('/home', 'HomeController@index');

