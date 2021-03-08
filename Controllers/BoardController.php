<?php namespace Controllers;

use Core\Core;

class BoardController 
{
    public function index() {
        return Core::view("board/index", ['title' => 'Board']);
    }
}