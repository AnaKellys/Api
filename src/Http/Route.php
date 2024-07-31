<?php

namespace App\Http;

class Route
{
    private static array $routes = [];


    private static function setRoute(string $path, string $action, string $method)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => $method
        ];
    }

    public static function get(string $path, string $action)
    {
        self::setRoute($path, $action, Request::METHOD_GET);
    }

    public static function post(string $path, string $action)
    {
        self::setRoute($path, $action, Request::METHOD_POST);
    }

    public static function put(string $path, string $action)
    {
        self::setRoute($path, $action, Request::METHOD_PUT);

    }

    public static function delete(string $path, string $action)
    {
        self::setRoute($path, $action, Request::METHOD_DELETE);
    }

    public static function routes()
    {
        return self::$routes;
    }
}
