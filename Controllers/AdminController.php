<?php

namespace Controllers;

use Core\Core;
use Helpers\Helper;
use Model\User;

class AdminController
{
    public function index()
    {
        $allUsers = (new User())->getAllUsers();
        $allRoles = User::getAllRoles();

        return Core::view('admin/index', [
            'allUsers' => $allUsers,
            'allRoles' => $allRoles,
        ]);
    }

    public function userRole()
    {
        if (!Helper::isPostSet('saveNewUserRole')) {
            return header(Core::$header . '/admin');
        }
        // get the currently logged in user
        $user = new User(session: true);
        $user->authUser();
        // check if user is an admin
        if ($user->role !== 'admin') {
            return header(Core::$header);
        }
        // check if a new role was actually selected
        if (empty($_POST['newUserRole']) || empty($_POST['userId'])) {
            return header(Core::$header . '/admin');
        }
        $newRole = Helper::sanitize($_POST['newUserRole']);
        $userId = Helper::sanitize($_POST['userId']);

        $newRoleUser = new User($userId);
        if ($newRoleUser->setRole($newRole)) {
            return header(Core::$header . '/admin');
        }

    }
}
