<?php

use Cakyuz\Core\Route;

/**
 * @param string $name
 * @param array $params
 * @return string
 */
function route(string $name, array $params = []): string
{
    return Route::url($name, $params);
}