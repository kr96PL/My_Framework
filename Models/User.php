<?php 

declare(strict_types = 1);

namespace Framework\Models;

use Framework\Core\Model;

class User extends Model
{
    protected array $columns = [
        'name',
        'surname',
        'email',
        'password'
    ];
}