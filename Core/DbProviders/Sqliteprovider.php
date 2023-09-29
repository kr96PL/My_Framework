<?php 

declare(strict_types = 1);

namespace Framework\Core\DbProviders;

use Framework\Core\DbProviderInterface;
use PDO;

class SqliteProvider implements DbProviderInterface
{
    public function getConfig(): PDO
    {
        $path = $_ENV['DB_PATH'];
        
        return  new PDO("sqlite:$path");
    }
}