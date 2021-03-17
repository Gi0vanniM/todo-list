<?php

namespace Controllers;

use Core\Core;

class AdminController
{
    public function index()
    {
        return Core::view('admin/index');
    }
}
