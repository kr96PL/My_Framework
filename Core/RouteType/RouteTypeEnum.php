<?php 

declare(strict_types = 1);

namespace Framework\Core\RouteType;

enum RouteTypeEnum: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}