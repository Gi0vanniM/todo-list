<?php

namespace Controllers;

use Core\Core;

class HomeController
{
    public function index()
    {
        Core::view('home/index', ['title' => 'Home']);
    }
}
