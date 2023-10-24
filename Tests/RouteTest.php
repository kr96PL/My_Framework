<?php 

declare(strict_types = 1);

namespace Framework\Tests;

use Exception;
use Framework\Core\Route;
use Framework\Core\RouteType\RouteTypeEnum;
use PHPUnit\Framework\TestCase;

final class RouteTest extends TestCase 
{
    public function testCanCreateRouteCorrectly()
    {
        $fn = fn() => "test";
        $route = new Route(RouteTypeEnum::GET, '/test', $fn);

        $type = $route->getType() === 'GET';
        $path = $route->getPath() === '/test';
        $callback = call_user_func($route->getCallback()) === $fn();
        $result = false;

        if ($type && $path && $callback) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    public function testCanAddMiddlewareToRoute()
    {
        $route = new Route(RouteTypeEnum::GET, '/test', fn() => "test");
        $result = false;
        $testMiddlewareContent = <<<'EOF'
        <?php 
        declare(strict_types = 1);
        namespace Framework\Middlewares;
        use Framework\Core\Interfaces\MiddlewareInterface;
        class AuthMiddleware implements MiddlewareInterface
        {
            public function __invoke(callable $next)
            {
                return $next();
            }
        }
        EOF;
        $f = fopen(dirname(__DIR__) . '/Middlewares/TestMiddleware.php', 'w+');
        fwrite($f, $testMiddlewareContent);
        $route->middleware('test');
        
        if (['TestMiddleware'] === $route->getMiddlewares()) {
            $result = true;
        }

        fclose($f);
        unlink(dirname(__DIR__) . '/Middlewares/TestMiddleware.php');

        $this->assertTrue($result);
    }

    public function testCannotAddMiddlewareToRouteWhichDoesntExist()
    {
        $route = new Route(RouteTypeEnum::GET, '/test', fn() => "test");
        try {
            $route->middleware('test');
        } catch (Exception $e) {
            $error_happend = true;
        }
        $this->assertTrue($error_happend);
    }
}