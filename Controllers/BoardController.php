<?php

namespace Controllers;

use Core\Core;
use Helpers\Helper;
use Model\uList;
use Model\User;

class BoardController 
{
    public static $boardUrl = "/board";

    public function index() {
        $user = new User(session: true);

        // use the authUser method
        $user->authUser();

        // get the user's lists
        $lists = (new uList())->getListsByUser($user->id);

        return Core::view("board/index", ['title' => 'Board', 'lists' => $lists]);
    }

    public function addList()
    {
        if (!Helper::isPostSet('addList')) {
            return header(Core::$header . self::$boardUrl);
        }

        // get the user
        $user = new User(session: true);

        // use the authUser method
        $user->authUser();

        // name of new list and sanitize it
        $newListName = Helper::sanitize($_POST['newListName']);

        $list = new uList();
        if ($list->create($user->id, $newListName)) {
            return header(Core::$header . self::$boardUrl);
        }

        return header(Core::$header . self::$boardUrl);
    }

    public function updateList() {}

    public function removeList() {}
}