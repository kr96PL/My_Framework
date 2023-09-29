<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Framework\Core\Db;

class App
{
    public DbProviderInterface $db;

    public function __construct() 
    {
        $this->db = Db::getInstance();
    }

    public function run(): string
    {
        return "App Running";
    }
}