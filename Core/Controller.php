<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;

abstract class Controller 
{
    private string $view_files_path;

    public function __construct()
    {
        $this->view_files_path = dirname(__DIR__) . '/Views/';
    }
 
    public function view(string $view_file, array $content = []): string
    {
        if (!file_exists($this->view_files_path . $view_file . '.php')) {
            throw new Exception("View: $view_file doesn't exist");
        }

        ob_start();
        include_once($this->view_files_path . $view_file . '.php');
        $context = ob_get_flush();
        ob_end_clean();

        if (!empty($content)) {
            foreach ($content as $key => $var) 
            {
                $context = preg_replace('/{\$' . $key . '}/', (string)$var, $context);
            }
        }

        return $context;
    }
}