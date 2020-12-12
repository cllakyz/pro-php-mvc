<?php


namespace Cakyuz\Core;


use Cakyuz\Core\Helpers\Redirect;

/**
 * Class Route
 * @package Cakyuz\Core
 */
class Route
{
    public static bool $hasRoute = false;
    public static array $routes = [];
    public static array $patterns = [
        ':id[0-9]?' => '([0-9]+)',
        ':url[0-9]?' => '([0-9a-zA-Z-_]+)',
    ];
    public static string $prefix = '';

    /**
     * @param string $path
     * @param $callback
     * @return Route
     */
    public static function get(string $path, $callback): Route
    {
        self::$routes['get'][self::$prefix . $path] = [
            'callback' => $callback
        ];
        return new self();
    }

    /**
     * @param string $path
     * @param $callback
     * @return Route
     */
    public static function post(string $path, $callback): Route
    {
        self::$routes['post'][self::$prefix . $path] = [
            'callback' => $callback
        ];
        return new self();
    }

    public static function dispatch()
    {
        $url    = self::getUrl();
        $method = self::getMethod();

        foreach (self::$routes[$method] as $path => $props) {
            foreach (self::$patterns as $key => $pattern) {
                $path = preg_replace('#' . $key . '#', $pattern, $path);
            }
            $pattern = '#^' . $path . '$#';

            if (preg_match($pattern, $url, $params)) {
                self::$hasRoute = true;
                array_shift($params);

                if (array_key_exists('redirect', $props)) {
                    Redirect::to($props['redirect'], $props['status']);
                }
                else {
                    $callback = $props['callback'];

                    if (is_callable($callback)) {
                        echo call_user_func_array($callback, $params);
                    }
                    elseif (is_string($callback)) {
                        [$className, $methodName] = explode('@', $callback);
                        $className = '\Cakyuz\App\Controllers\\' . $className;
                        $controller = new $className();
                        echo call_user_func_array([$controller, $methodName], $params);
                    }
                }
            }
        }
        self::hasRoute();
    }

    public static function hasRoute()
    {
        if (self::$hasRoute === false) {
            exit('Page not found');
        }
    }

    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @param string $name
     */
    public function name(string $name): void
    {
        $key = array_key_last(self::$routes['get']);
        self::$routes['get'][$key]['name'] = $name;
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     */
    public static function url(string $name, array $params = []): string
    {
        $route = array_key_first(array_filter(self::$routes['get'], function ($route) use ($name) {
            return isset($route['name']) && $route['name'] === $name;
        }));
        return getenv('SITE_URL') . str_replace(array_map(fn($key) => ':' . $key, array_keys($params)), array_values($params), $route);
    }

    /**
     * @param string $prefix
     * @return Route
     */
    public static function prefix(string $prefix): Route
    {
        self::$prefix = $prefix;
        return new self();
    }

    /**
     * @param \Closure $closure
     */
    public static function group(\Closure $closure): void
    {
        $closure();
        self::$prefix = '';
    }

    /**
     * @param string $key
     * @param string $pattern
     */
    public function where(string $key, string $pattern): void
    {
        self::$patterns[':' . $key] = '(' . $pattern . ')';
    }

    /**
     * @param string $from
     * @param string $to
     * @param int $status
     */
    public static function redirect(string $from, string $to, int $status = 301): void
    {
        self::$routes['get'][$from] = [
            'redirect' => $to,
            'status' => $status,
        ];
    }
}