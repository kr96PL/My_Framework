<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;

class Response
{
    public function __call($name, $arguments)
    {
        $class_name = ucfirst($name) . 'Response';
        if (!file_exists(__DIR__ . '/Response/' . $class_name . '.php')) {
            throw new Exception($class_name . ' doesnt exist');
        } 
        $class_name = '\Framework\Core\Response\\' . $class_name; 
        return (new $class_name())->return($arguments);
    }
}