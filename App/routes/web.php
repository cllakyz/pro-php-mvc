<?php

use Cakyuz\Core\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/users/:id', 'UsersController@show')->name('users.show');
// echo route('users.show', ['id' => 3]);

Route::get('/@:username', function ($username) {
    return 'Username: '. $username;
})->where('username', '[a-z]+');

Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return 'admin home page';
    });
});

Route::get('/articles', 'ArticlesController@index')->name('articles');
Route::get('/articles/:url', 'ArticlesController@show')->name('articles.show');

Route::redirect('/php-dersleri', '/php');