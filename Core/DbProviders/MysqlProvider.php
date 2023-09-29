<?php 

declare(strict_types = 1);

namespace Framework\Core\DbProviders;

use Framework\Core\DbProviderInterface;
use PDO;

class MysqlProvider implements DbProviderInterface
{
    public function getConfig(): PDO
    {
        $host =  $_ENV['DB_HOST'];
        $name = $_ENV['DB_NAME'];

        return new PDO("mysql:host=$host;dbname=$name", $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }
}