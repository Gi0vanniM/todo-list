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

    /**
     * create a task
     *
     * @param int $list_id
     * @param string $description
     * @param int $duration
     * @param int $status_id
     * @return boolean
     */
    public function create($list_id, $description, $duration, $status_id)
    {
        if (!$list_id || !$description || !$duration || !$status_id) {
            return false;
        }

        $this->list_id = Helper::sanitize($list_id);
        $this->description = Helper::sanitize($description);
        $this->duration = Helper::sanitize($duration);
        $this->status_id = Helper::sanitize($status_id);

        $sql = 'INSERT INTO tasks (list_id, description, duration, status_id) VALUES (:list_id, :description, :duration, :status_id)';
        $args = [
            'list_id' => $this->list_id,
            'description' => $this->description,
            'duration' => $this->duration,
            'status_id' => $this->status_id,
        ];

        if ($this->db->run($sql, $args)) {
            return true;
        }

        return false;
    }
}
