<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Framework\Core\Db;

class App
{
    public DbProviderInterface $db;
    public Router $router;
    

    public function __construct(Router $router) 
    {
        $this->db = Db::getInstance();
        $this->router = $router;
    }

    public function run(): void
    {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = $_SERVER['REQUEST_URI']; 

        if ($route = $this->router->getRoute($request_method, $request_uri)) {
            $callback = $route->getCallback();
            if (is_array($callback)) {
                $class = $callback[0];
                $method = $callback[1];
                echo (new $class())->$method();
                return;
            } 
            echo call_user_func($callback);
            return;
        }
    }
}