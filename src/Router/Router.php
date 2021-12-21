<?php

namespace App\Router;

use Exception;

class Router
{

    private array $routes;
    private array $names;

    public function __construct(private $url)
    {
    }

    public function get($path, $callable, $name = null): Route
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null): Route
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    public function any($path, $callable, $name = null): Route
    {
        return $this->add($path, $callable, $name, $_SERVER['REQUEST_METHOD']);
    }

    private function add($path, $callable, $name, $method): Route
    {
        $route = new Route($path, $callable);

        $this->routes[$method][] = $route;

        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->names[$name] = $route;
        }

        return $route;
    }

    /**
     * @throws Exception
     */
    public function url($name, $params = [])
    {
        if (!isset($this->names[$name])) {
            throw new Exception('no matches name');
        }

        return $this->names[$name]->getUrl($params);
    }

    /**
     * @throws Exception
     */
    public function start()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new Exception('Route does not match');
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }

        throw new Exception('No Matching Routes');
    }
}