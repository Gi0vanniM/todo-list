<?php

namespace Controllers;

use Core\Core;
use Helpers\Helper;

class BoardController 
{
    public static $boardUrl = "location: //" . APP_URL . "/board";

    public function index() {
        return Core::view("board/index", ['title' => 'Board']);
    }

    public function addList()
    {
        if (!Helper::isPostSet('addList')) {
            return header(self::$boardUrl);
        }
        // TODO: add/create list



        return header(self::$boardUrl);
    }
}