<?php

declare(strict_types = 1);

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        var_dump($request->all());
    }
}