<?php 

declare(strict_types = 1);

namespace Framework\Core\Enums;

enum RequestParameterType: string 
{
    case text = 'text';
    case email = 'email';
    case number = 'number';
    case password = 'password';
    case confirm_password = 'confirm_password';
}