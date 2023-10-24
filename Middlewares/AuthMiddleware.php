<?php 

declare(strict_types = 1);

namespace Framework\Middlewares;

use Framework\Core\Interfaces\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function __invoke(callable $next)
    {
        if (!isset($_SESSION['AUTH'])) {
            header("Location: /");
            return;
        }
        return $next();
    }
}