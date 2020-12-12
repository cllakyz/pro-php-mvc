<?php

/**
 * @param string $name
 * @param array $params
 * @return string
 */
function route(string $name, array $params = []): string
{
    return \Cakyuz\Core\Route::url($name, $params);
}

/**
 * @param string $name
 * @param array $data
 * @return string
 */
function view(string $name, array $data = []): string
{
    return \Cakyuz\Core\View::show($name, $data);
}