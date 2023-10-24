<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;
use Framework\Core\RouteType\RouteTypeEnum;

final class Router 
{
    private array $routes = [
        'GET' => [], 
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    public function get(string $path, object|array $callback): Route
    {
        if ($this->getRoute('GET', $path)) {
            throw new Exception("Path: $path in already declared");
        }
        $route = new Route(RouteTypeEnum::GET, $path, $callback);
        $this->routes['GET'][] = $route;
        return $route;
    } 

    public function post(string $path, object|array $callback): Route
    {
        if ($this->getRoute('POST', $path)) {
            throw new Exception("Path: $path in already declared");
        }
        $route = new Route(RouteTypeEnum::GET, $path, $callback);
        $this->routes['POST'][] = $route;
        return $route;
    } 

    public function getRoute(string $type, string $path): Route|bool
    {
        foreach ($this->routes[$type] as $route) 
        {
            if ($route->getPath() === $path) {
                return $route;
            }
        }
        return false;
    }
}