<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Framework\Core\Db;
use Framework\Core\RouteType\RouteTypeEnum;

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
            echo call_user_func($route->getCallback());
        }
    }
}