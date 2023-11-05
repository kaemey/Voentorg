<?php

namespace App\RMVC;
use App\Http\Controllers\UserController;
use App\RMVC\Route\Route;
use App\RMVC\Route\RouteDispatcher;

class App{

    public static function run(){

       UserController::checkUser();

        if ($_SERVER['REQUEST_URI'] == '/') Route::redirect('/home');
        
        $requestMethod = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $methodName = 'getRoutes' . $requestMethod;

        foreach(Route::$methodName() as $routeConfig){
            RouteDispatcher::checkRouteConfig($routeConfig);
        }

    }

}