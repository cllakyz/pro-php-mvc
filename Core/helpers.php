<?php

/**
 * @param $nesne
 */
function p($nesne): void
{
    echo "<pre>";
    print_r($nesne);
    echo "</pre>";
}

/**
 * @param $nesne
 */
function v($nesne): void
{
    echo "<pre>";
    var_dump($nesne);
    echo "</pre>";
}

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

/**
 * @param string $name
 * @return mixed
 */
function model(string $name): object
{
    $name = '\Cakyuz\App\Models\\' . ucfirst($name);
    return new $name();
}