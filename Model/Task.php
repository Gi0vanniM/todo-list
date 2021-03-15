<?php

namespace Model;

use Core\Database;
use Helpers\Helper;

class Task
{
    public $id;
    public $list_id;
    public $description;
    public $duration;
    public $status_id;
    public $created_at;

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
