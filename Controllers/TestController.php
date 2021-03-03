<?php

namespace Controllers;

use Core\Core;
use Helpers\Helper;
use Model\User;

class TestController
{
    public function index($args0 = null, $args1 = null)
    {
        // var_dump($this, 'index');
        $users = new User();

        // $allUsers = $users->getUsers()->fetchAll();

        $user = User::getUserById(1);

        // if ($us = Helper::find($allUsers, 'name', 'Giovanni')) {
        //     echo '<pre>';
        //     var_dump($us);
        //     // echo $us;
        //     echo '</pre>';
        // }
        return Core::view('home/index', ['title' => 'Home']);
    }
}
