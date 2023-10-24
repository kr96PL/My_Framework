<?php 

declare(strict_types = 1);

namespace Framework\Core\Interfaces;

use PDO;

interface DbProviderInterface
{
    public function getConfig(): PDO;
}