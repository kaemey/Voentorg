<?php

namespace App\RMVC\Route;

class Route_config{
    public string $route;
    public string $controller;
    public string $action;
    public string $name;
    public string $middleware;

    public function __construct(string $route, string $controller, string $action){
        $this->action = $action;
        $this->controller = $controller;
        $this->route = $route;
    }

    public function name(string $name): Route_config{
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): Route_config{
        $this->middleware = $middleware;
        return $this;
    }

}