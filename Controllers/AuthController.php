<?php

declare(strict_types = 1);

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Core\Request;
use Framework\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:8|max:255',
            'password' => 'required|text|min:8|max:40',
        ]);

        if ($request->errors()) {
            $this->redirect()->with(['errors' => $request->errors()])->back();
        }

        if (!$this->auth()->attemp($request->all())) {
            $this->redirect()->with(['errors' => 'password or email are incorrect'])->back();
        } 

        return $this->redirect()->back();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|text',
            'surname' => 'required|text',
            'email' => 'required|email|min:8|max:255',
            'password' => 'required|password|min:8|max:40',
            'confirm_password' => 'required|confirm_password'
        ]);

        if ($request->errors()) {
            $this->redirect()->with(['errors' => $request->errors()])->back();
        }

        $password = password_hash($request->password, PASSWORD_BCRYPT);

        $user = new User();
        $user->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $password
        ]);
    }
}