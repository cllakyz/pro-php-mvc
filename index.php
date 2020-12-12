<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/vendor/autoload.php';

use Cakyuz\Core\{App, Route};

$app = new App();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

require __DIR__ . '/App/routes/web.php';

Route::prefix('/api');
require __DIR__ . '/App/routes/api.php';
Route::prefix('');

Route::dispatch();