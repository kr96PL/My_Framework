<?php 

declare(strict_types = 1);

namespace Framework\Core\Interfaces;

interface ResponseInterface
{
    public function return(array $data);
}