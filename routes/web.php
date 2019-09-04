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
Auth::routes();

Route::group(['middleware' => 'user'], function() {
    Route::get('user/profile', 'Users\ProfileController@index');

    Route::put('/user/profile', 'Users\ProfileController@update');

    Route::get('/user/password', 'Users\PasswordController@index');

    Route::put('/user/password', 'Users\PasswordController@update');

    Route::get('user/post', 'Users\PostsController@index');

    Route::get('/user/post/create', 'Users\PostsController@create');

    Route::post('/user/post', 'Users\PostsController@store');

    Route::get('/user/post/{slug}/edit', 'Users\PostsController@edit');

    Route::put('/user/post/{slug}', 'Users\PostsController@update');

    Route::delete('/user/post/{slug}', 'Users\PostsController@destroy');
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin/profile', 'Admin\ProfileController@index');

    Route::put('/admin/profile', 'Admin\ProfileController@update');

    Route::get('/admin/password', 'Admin\PasswordController@index');

    Route::put('/admin/password', 'Admin\PasswordController@update');

    Route::get('/admin/user/password/{id}', 'Admin\Users\PasswordController@edit');

    Route::put('/admin/user/password/{id}', 'Admin\Users\PasswordController@update');

    Route::get('/admin/user', 'Admin\Users\ProfileController@index');

    Route::get('/admin/userlist', 'Admin\Users\ProfileController@listting');

    Route::post('/admin/userlist', 'Admin\Users\ProfileController@listting');

    Route::get('/admin/user/create', 'Admin\Users\ProfileController@create');

    Route::post('/admin/user','Admin\Users\ProfileController@store');

    Route::get('/admin/user/{id}/edit', 'Admin\Users\ProfileController@edit');

    Route::put('/admin/user/{id}', 'Admin\Users\ProfileController@update');

    Route::delete('/admin/user/{id}', 'Admin\Users\ProfileController@destroy');

    Route::get('/admin/category', 'Admin\CategoriesController@index');

    Route::get('/admin/categorylist', 'Admin\CategoriesController@listting');

    Route::post('/admin/categorylist', 'Admin\CategoriesController@listting');

    Route::get('/admin/category/create', 'Admin\CategoriesController@create');

    Route::post('/admin/category','Admin\CategoriesController@store');

    Route::get('/admin/category/{id}/edit', 'Admin\CategoriesController@edit');

    Route::put('/admin/category/{id}', 'Admin\CategoriesController@update');

    Route::delete('/admin/category/{id}', 'Admin\CategoriesController@destroy');

    Route::get('/admin/post', 'Admin\PostsController@index');

    Route::get('/admin/postlist', 'Admin\PostsController@listing');

    Route::post('/admin/postlist', 'Admin\PostsController@listing');

    Route::get('/admin/post/create', 'Admin\PostsController@create');

    Route::post('/admin/post', 'Admin\PostsController@store');

    Route::get('/admin/post/{id}/edit', 'Admin\PostsController@edit');

    Route::put('/admin/post/{id}', 'Admin\PostsController@update');

    Route::delete('/admin/post/{id}', 'Admin\PostsController@destroy');
});

Route::get('/', function () {
    return redirect('/en');
});

Route::get('/{locale}', 'HomeController@index');

Route::get('/admin/dashboard', 'Admin\HomeController@index');

Route::get('{locale}/category/{slug}', 'CategoriesController@show');

Route::get('/{locale}/{slug}', 'PostsController@show');