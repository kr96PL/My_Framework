<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Framework\Core\Db;
use PDO;
use ReflectionFunction;

class App
{
    public PDO $db;
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
        $pos = strpos($request_uri, '?');
        
        if ($pos) {
            $request_uri = substr($request_uri, 0, $pos);
        }

        if ($route = $this->router->getRoute($request_method, $request_uri)) {
            $middlewares = $route->getMiddlewares();
            $callback = $route->getCallback();
            $callback_fn = null;

            if (is_array($callback)) {
                $class = $callback[0];
                $method = $callback[1];
                $callback_fn = fn() => (new $class())->$method(new Request());
            } else {
                $reflection = new ReflectionFunction($callback);
                $parameters = $reflection->getParameters();
                $args = [];
                if (!empty($parameters)) {
                    foreach ($parameters as $parameter) 
                    {
                        if ($parameter->getName() === 'request') {
                            $args = ['request' => new Request()];
                        } else {
                            $args[] = [$parameter->getName() => $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null];
                        }  
                    }
                    var_dump($args);
                    exit;
                } 
                $callback_fn = fn() => call_user_func_array($callback, $args);
            }

            if (!empty($middlewares)) {
                $action = null;
                foreach ($middlewares as $middleware) 
                {
                    $class_name = 'Framework\Middlewares\\' . $middleware;
                    $middleware_instance = new $class_name();
                    $action = $middleware_instance($callback_fn);
                }
                echo $action();
                return;
            }

            echo $callback_fn();
            return;
        }
    }
}