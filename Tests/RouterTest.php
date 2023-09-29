<?php 

declare(strict_types = 1);

namespace Framework\Tests;

use Exception;
use Framework\Core\Route;
use Framework\Core\Router;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase 
{
    public function testCanRegisterRouteCorrectly_GET()
    {
        $router = new Router();
        $router->get('/test1', fn() => 'test');
        $this->assertInstanceOf(Route::class, $router->getRoute('GET', '/test1'));
    } 

    public function testCannotFindRouteDoesntExist_GET()
    {
        $router = new Router();
        $this->assertFalse($router->getRoute('GET', '/test404'));
    }

    public function testCannotRegisterMoreThanOneRouteInOnePath_GET()
    {
        $router = new Router();
        $router->get('/test1', fn() => 1);
        try {
            $router->get('/test1', fn() => 1);
        } catch (Exception $e) {
            $error_happened = true;
        }
        $this->assertTrue($error_happened);
    }
}