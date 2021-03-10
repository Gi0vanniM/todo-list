<?php

namespace Model;

use Core\Database;

// couldn't use the name 'List' so it's 'uList' now for user List
class uList
{
    public $id;
    public $user_id;
    public $list_name;
    public $created_at;

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getList() {}

    public function create() {}

    public function update() {}

    public function delete() {}
}
