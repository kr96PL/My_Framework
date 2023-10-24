<?php 

declare(strict_types = 1);

namespace Framework\Core;

abstract class Controller 
{
    public function view(string $view_file, array $content = []): string
    {
        return (new View())->show($view_file, $content);
    }
}