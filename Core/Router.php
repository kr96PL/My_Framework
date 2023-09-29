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

    public function get(string $path, object $callback): void
    {
        if ($this->getRoute('GET', $path)) {
            throw new Exception("Path: $path in already declared");
        }
        $this->routes['GET'][] = new Route(RouteTypeEnum::GET, $path, $callback);
    } 

    public function post(string $path, object|callable $callback): void
    {
        if ($this->getRoute('POST', $path)) {
            throw new Exception("Path: $path in already declared");
        }
        $this->routes['POST'][] = new Route(RouteTypeEnum::GET, $path, $callback);
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