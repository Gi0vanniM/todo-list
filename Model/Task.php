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
     * get tasks by user id
     *
     * @param [type] $userId
     * @return void
     */
    public function getTasksByUserId($userId)
    {
        $query = $this->db->run(
            'SELECT * FROM tasks
            LEFT JOIN lists ON lists.id=tasks.list_id
            WHERE lists.user_id=:user_id',
            ['user_id' => $userId]
        )->fetchAll();

        return $query;
    }

    /**
     * get tasks by list id
     *
     * @param int $listId
     * @return array
     */
    public function getTasksByListId($listId)
    {
        $query = $this->db->run(
            'SELECT * FROM tasks WHERE list_id=:list_id',
            ['list_id' => $listId]
        )->fetchAll();

        return $query;
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

    public function update()
    {
    }

    public function delete()
    {
    }
}
