<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;

class View  
{
    private string $view_files_path;

    public function __construct()
    {
        $this->view_files_path = dirname(__DIR__) . '/Views/';
    }

    public function show(string $view_name, array $content = []): string
    {
        if (!file_exists($this->view_files_path . $view_name . '.php')) {
            throw new Exception("View: $view_name doesn't exist");
        }

        ob_start();
        foreach ($content as $key => $value) 
        {
            $$key = $value;
        }
        
        include_once($this->view_files_path . $view_name . '.php');
        $context = ob_get_flush();
        ob_end_clean();

        return $context;
    }
}