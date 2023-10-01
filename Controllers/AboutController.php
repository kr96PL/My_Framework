<?php

declare(strict_types = 1);

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $user = new User();
        $user->create([
            'name' => 'Nadia',
            'surname' => 'Kępka',
            'email' => 'nadiakepka@gmail.com',
            'password' => 'test',
        ]);
        exit;
        return $this->view('about', ['name' => 'Kacper', 'age' => 27]);
    }
}
