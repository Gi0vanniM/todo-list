<?php

namespace Controllers;

use Core\Core;
use Helpers\Helper;
use Model\Task;
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

        $statuses = Helper::getAllStatus();

        return Core::view("board/index", ['title' => 'Board', 'lists' => $lists, 'statuses' => $statuses]);
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

    public function updateList()
    {
        // check if request is not post
        if (!Helper::isPostSet()) {
            return false;
        }
        // get the user
        $user = new User(session: true);
        // authenticate user
        $user->authUser();

        // sanitize inputs
        $listId = Helper::sanitize($_POST['id']);
        $listName = Helper::sanitize($_POST['listName']);

        $list = new uList();
        // get the list
        $list->getList($listId);

        // check if user owns the list
        if ($list->user_id !== $user->id) {
            return false;
        }
        // update the list
        if ($list->update($listId, $listName)) {
            return;
        }
    }

    public function deleteList()
    {
        if (!Helper::isPostSet()) {
            return header(Core::$header . self::$boardUrl);
        }

        $user = new User(session: true);
        $user->authUser();

        $listId = Helper::sanitize($_POST['id']);

        $list = new uList();
        $list->getList($listId);

        if ($list->user_id !== $user->id) {
            return false;
        }

        if ($list->delete()) {
            return header(Core::$header . self::$boardUrl);
        }
    }



    public function addTask()
    {
        if (!Helper::isPostSet('addTask')) {
            return header(Core::$header . self::$boardUrl);
        }
        // get the user and authenticate
        $user = new User(session: true);
        $user->authUser();

        // get the list
        $listId = Helper::sanitize($_POST['listId']);
        $list = new uList();
        $list->getList($listId);
        // check if the list belongs to the user
        if ($list->user_id !== $user->id) {
            return header(Core::$header . self::$boardUrl);
        }
        // sanitize the inputs
        $description = Helper::sanitize($_POST['taskDescription']);
        $duration = Helper::sanitize($_POST['taskDuration']);
        $statusId = Helper::sanitize($_POST['taskStatus']);
        // create the task and head back to overview
        $task = new Task();
        if ($task->create($listId, $description, $duration, $statusId)) {
            return header(Core::$header . self::$boardUrl);
        }
    }

    public function updateTask() {}

    public function removeTask() {}

}