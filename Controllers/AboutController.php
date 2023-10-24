<?php

declare(strict_types = 1);

namespace Framework\Controllers;

use Framework\Core\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return $this->view('about', ['name' => 'Kacper', 'age' => 27]);
    }
}
