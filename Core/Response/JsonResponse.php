<?php 

declare(strict_types = 1);

namespace Framework\Core\Response;

use Framework\Core\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    public function return(array $data)
    {
        $json = json_encode($data);
        header('Content-Type: application/json');
        return $json;
    }
}