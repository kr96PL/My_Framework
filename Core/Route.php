<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Framework\Core\RouteType\RouteTypeEnum;

class Route 
{
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
}