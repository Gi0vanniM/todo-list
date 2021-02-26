<?php

use Core\Core;

class homeController
{
    public function index()
    {
        Core::view('home/index', ['title' => 'Home']);
    }
}
