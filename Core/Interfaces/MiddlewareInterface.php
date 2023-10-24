<?php 

declare(strict_types = 1);

namespace Framework\Core\Interfaces;

interface MiddlewareInterface
{
    public function __invoke(callable $next);
}