<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;

class Request 
{
    private array $params = [];

    public function __construct()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $this->params = $method === 'GET' ? $_GET : $_POST;
    }

    public function __get($name)
    {
        if (!isset($this->params[$name])) {
            throw new Exception("Parameter: $name doesn't exist in request");
        }
        return $this->params[$name];
    }

    public function all(): array 
    {
        return $this->params;
    }
}