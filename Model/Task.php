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
     * Get tasks by user id
     * 
     * $sort is used to determine what 
     * by what column the result is ordered.
     * $dir is used to determine what 
     * direction the ordering goes.
     *
     * @param [type] $userId
     * @param string $sort
     * @param string $dir
     * @return void
     */
    public function getTasksByUserId($userId, $sort = 'id', $dir = 'asc')
    {
        $query = $this->db->run(
            'SELECT tasks.* FROM tasks
            LEFT JOIN lists ON lists.id=tasks.list_id
            WHERE lists.user_id=:user_id
            ORDER BY :sort :dir',
            [
                'user_id' => $userId,
                'sort' => 'tasks.' . $sort,
                'dir' => $dir
            ]
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
     * get a task by id
     * if return is set to true it will return the Task class
     *
     * @param [type] $id
     * @param boolean $return
     * @return void
     */
    public function getTask($id, $return = false)
    {
        $query = $this->db->run(
            'SELECT * FROM tasks WHERE id=:id',
            ['id' => $id]
        )->fetch();

        $this->id = $query->id;
        $this->list_id = $query->list_id;
        $this->description = $query->description;
        $this->duration = $query->duration;
        $this->status_id = $query->status_id;
        $this->created_at = $query->created_at;

        if ($return) {
            return $this;
        }
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
        if (!$list_id || !$description || !isset($duration) || !$status_id) {
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

    /**
     * update a task
     *
     * @param [type] $id
     * @param [type] $description
     * @param [type] $duration
     * @param [type] $status_id
     * @return void
     */
    public function update($id = null, $description, $duration, $status_id)
    {
        if (!$description || !isset($duration) || !$status_id) {
            return false;
        }
        // if id is set, sanitize it and set it to local variable
        if ($id) {
            $this->id = Helper::sanitize($id);
        }
        // sanitize inputs
        $this->description = Helper::sanitize($description);
        $this->duration = Helper::sanitize($duration);
        $this->status_id = Helper::sanitize($status_id);
        // set prepared statement
        $sql = 'UPDATE tasks SET description=:description, duration=:duration, status_id=:status_id WHERE id=:id';
        $args = [
            'id' => $this->id,
            'description' => $this->description,
            'duration' => $this->duration,
            'status_id' => $this->status_id,
        ];
        if ($this->db->run($sql, $args)) {
            return true;
        }
        return false;
    }

    /**
     * delete a task
     *
     * @return void
     */
    public function delete()
    {
        if (isset($id)) {
            $this->id = Helper::sanitize($id);
        }

        $sql = 'DELETE FROM tasks WHERE id=:id';
        $args = [
            'id' => $this->id
        ];

        if ($this->db->run($sql, $args)) {
            return true;
        }
        return false;
    }
}
