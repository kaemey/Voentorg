<?php

namespace App\RMVC\Route;
use App\RMVC\Route\Route_config;

class Route{
    private static array $routesGet = [];
    private static array $routesPost = [];

    public static function getRoutesGet(): array{
        return self::$routesGet;
    }

    public static function getRoutesPost(): array{
        return self::$routesPost;
    }

    public static function get(string $route,array $controller): Route_config{
        $Route_config = new Route_config($route, $controller[0], $controller[1]);
        self::$routesGet[] = $Route_config;
        return $Route_config;
    }

    public static function post(string $route,array $controller): Route_config{
        $Route_config = new Route_config($route, $controller[0], $controller[1]);
        self::$routesPost[] = $Route_config;
        return $Route_config;
    }

    public static function redirect($url){
        header("Location: ".$url);
    }

}