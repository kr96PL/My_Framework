<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;
use Framework\Core\RouteType\RouteTypeEnum;

class Route 
{
    private array $middlewares = [];

    public function __construct(private RouteTypeEnum $type, private string $path, private object|array $callback) {}

    public function getType(): string
    {
        return $this->type->value;
    }

    public function getPath(): string 
    {
        return $this->path;
    }

    public function getCallback(): object|array
    {
        return $this->callback;
    }

    public function middleware(string $name): void
    {
        $middlewares_dir = dirname(__DIR__) . '/Middlewares/';
        $middleware_name = ucfirst($name) . 'Middleware';
        $file_name = $middlewares_dir . $middleware_name . '.php';
        if (!file_exists($file_name)) {
            throw new Exception("Middleware: $middleware_name doesn't exist.");
        }
        $this->middlewares[] = $middleware_name;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}