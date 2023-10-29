<?php

declare(strict_types = 1);

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Core\Request;

class HomeController extends Controller
{
    public function index()
    {
        return $this->response()->xml([
            'name' => 'Kapi'
        ]);
        return $this->view('home');
    }

    public function store(Request $request)
    {
        var_dump($request->all());  
    }
}
