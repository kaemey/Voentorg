<?php

namespace App\RMVC\Route;

class RouteDispatcher{

    public static function checkRouteConfig(Route_config $routeConfig){

        $uri = $_SERVER['REQUEST_URI'];
        
        if ($uri !== '/'){
            $routeConfig->route = preg_replace('/(^\/)|(\/$)/', '', $routeConfig->route);
            $uri = preg_replace('/(^\/)|(\/$)/', '', $uri);
        }

        $routesArray = explode('/', $routeConfig->route);
        $uriArray = explode('/', $uri);

        $paramMap = [];
        $paramArray = [];

        foreach($routesArray as $paramIndex => $param){

            if(preg_match('/{.*}/', $param)){
                $paramMap[$paramIndex] = preg_replace('/(^{)|(}$)/', '', $param);
            }

        }

        foreach($paramMap as $paramIndex => $param){

            if (!isset($uriArray[$paramIndex]))
            return;
            
            $paramArray[$param] = $uriArray[$paramIndex];
            $uriArray[$paramIndex] = '{.*}';

        }

        $uri = implode('\/', $uriArray);

        if (preg_match("/$uri/", $routeConfig->route)){

            $className = $routeConfig->controller;
            $action = $routeConfig->action;

           print( (new $className)->$action(...$paramArray) );

        }

    }

}