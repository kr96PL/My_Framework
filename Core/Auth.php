<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;
use Framework\Models\User;

class Auth  
{
    public function attemp(array $params): bool
    {
        if (!$this->checkParamsCorrect($params)) {
            throw new Exception('Incorrect parameters passed to attemp');
        }

        $user = new User();
        $founded_user = $user->find('email', $params['email']);

        if (empty($founded_user)) {
            throw new Exception('User doesnt found');
        }

        if (!password_verify($params['password'], $founded_user[0]['password'])) {
            return false;
        }

        $this->login($founded_user);

        return true;
    }

    public function user(): User|null
    {
        if (!isset($_SESSION['AUTH'])) {
            return null;
        }
        return $_SESSION['user'];
    }

    private function checkParamsCorrect(array $params): bool
    {
        if (!empty(array_diff(array_keys($params), ['email', 'password']))) {
            return false;
        }
        return true;
    }

    private function login(array $founded_user)
    {
        $_SESSION['AUTH'] = true;
        $_SESSION['user'] = $founded_user;
    }
}