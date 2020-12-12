<?php

require __DIR__ . '/vendor/autoload.php';

use Cakyuz\Core\{App, Route};

$app = new App();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

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

Route::redirect('/php-dersleri', '/php');

Route::dispatch();