<?php 

namespace Controllers\Auth;

use Core\Core;

class Login 
{
    public function index()
    {
        return Core::view('auth/login');
    }
}

class Register
{
    public function index()
    {
        return Core::view('auth/register');
    }
}

class Logout
{
    public function index()
    {
        //
    }
}