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

Route::get('/', 'WelcomeController@index')->name('welcome');
// Route::get('posts/search', 'WelcomeController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
  Route::resource('category', 'CategoryController');
  Route::resource('post', 'PostController');
  Route::resource('tag', 'TagController');
  Route::get('/trashed', 'PostController@trashed')->name('trashed.index');
  Route::put('/restore/{post}', 'PostController@restore')->name('restore-posts');
});

Route::middleware(['auth', 'admin'])->group(function() {
  Route::get('users', 'UsersController@index')->name('users.index');
  Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

// Route::get('users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
// Route::put('users/{id}/update', 'UsersController@update')->name('users.update');
Route::put('users/profile', 'UsersController@update')->name('users.update-profile');

Route::get('blog/posts/{id}', 'PostsController@show')->name('blog.show');
Route::get('blog/categories/{id}', 'PostsController@category')->name('blog.category');
Route::get('blog/tags/{id}', 'PostsController@tag')->name('blog.tag');

