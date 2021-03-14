<?php

namespace Model;

use Core\Database;
use Helpers\Helper;

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

    /**
     * get a list by id and put the data into class object
     * when $return is true, will return the query
     *
     * @param int $id
     * @param boolean $return
     * @return void
     */
    public function getList($id, $return = false)
    {
        $query = $this->db->run(
            'SELECT * FROM lists WHERE id=:id',
            ['id' => $id]
        )->fetch();

        $this->id = $query->id;
        $this->user_id = $query->user_id;
        $this->list_name = $query->list_name;
        $this->created_at = $query->created_at;

        if ($return) {
            return $query;
        }
    }

    /**
     * get all lists from user
     *
     * @param [type] $user_id
     * @return void
     */
    public function getListsByUser($user_id) 
    {
        $sql = 'SELECT * FROM lists WHERE user_id=:user_id';
        $args = ['user_id' => $user_id];

        $query = $this->db->run($sql, $args)->fetchAll();

        return $query;
    }

    /**
     * create a list
     *
     * @param Int $user_id
     * @param String $list_name
     * @return boolean
     */
    public function create($user_id, $list_name)
    {
        if (!$user_id || !$list_name) {
            return false;
        }

        $this->user_id = Helper::sanitize($user_id);
        $this->list_name = Helper::sanitize($list_name);

        $sql = 'INSERT INTO lists (user_id, list_name) VALUES (:user_id, :list_name)';
        $args = [
            'user_id' => $this->user_id,
            'list_name' => $this->list_name,
        ];

        if ($this->db->run($sql, $args)) {
            return true;
        }

        return false;
    }

    public function update($id) {}

    public function delete($id) {}
}
