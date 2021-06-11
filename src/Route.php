<?php

namespace Core;

class Route {
    protected $routes = [];

    public function add($route, $action){
        $this->routes[$route] = $action; 
    }

    public function run($url){
        //remove from url $_GET variables
        $route = $this->removeQueryVariables($url);
        
        // remove / from route, if URL is / removing we need to add / to routes table
        $route = trim($route,'/');
        if($route == ''){ $route = "/";}
        
        // check if route exists in routes table
        if(array_key_exists($route,$this->routes)){
            $parameter = explode('@',$this->routes[$route]);
            $method = $parameter[1];
            $controller = $this->getNamespace().$parameter[0];
            
            // create new instance for controller
            if(class_exists($controller)){    
                $controller = new $controller;
                return $controller->$method();
            } 
            else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        };

        
    }

    protected function removeQueryVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    protected function getNamespace(){
        return '\App\Controllers\\';
    }
}