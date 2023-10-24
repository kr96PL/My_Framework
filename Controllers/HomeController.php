<?php

declare(strict_types = 1);

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Core\Request;
use Framework\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = (new User())->all();
        return $this->view('home', ['users' => $users]);
    }

    public function store(Request $request)
    {
        var_dump($request->all());  
    }
}
