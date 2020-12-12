<?php


namespace Cakyuz\Core;


use Jenssegers\Blade\Blade;

/**
 * Class View
 * @package Cakyuz\Core
 */
class View
{
    /**
     * @param string $viewName
     * @param array $data
     * @return string
     */
    public static function show(string $viewName, array $data = []): string
    {
        $viewName = str_replace('.', '/', $viewName);

        $blade = new Blade(dirname(__DIR__) . '/public/views', dirname(__DIR__) . '/public/cache');
        return $blade->render($viewName, $data);
    }
}