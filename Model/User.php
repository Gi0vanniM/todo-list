<?php

namespace Model;

use Core\Database;

class User extends Database
{

    public $username;
    public $role;
    public $created_at;

    private $password;

    /**
     * get all the users in the database
     *
     * @return User[]
     */
    public function getAllUsers()
    {
        return $this->run('SELECT * FROM users');
    }

    /**
     * get a specific user by id
     *
     * @param [type] $id
     * @return User
     */
    public static function getUserById($id)
    {
        return $jeff = (new Database())->run('SELECT username, created_at FROM users WHERE id=:id', ['id' => $id])->fetch();
    }

    /**
     * update a user
     *
     * @param [type] $username
     * @param [type] $password
     * @return void
     */
    public function updateUser($username, $password)
    {
        $sql = 'UPDATE users SET username=:username, password=:password';
        $args = [
            'username' => $username,
            'password' => $password,
        ];
        $this->run($sql, $args);
    }

    /**
     * create a user
     *
     * @param [type] $username
     * @param [type] $password
     * @return void
     */
    public function createUser($username, $password)
    {
        $sql = 'INSERT INTO users username=:username, password=:password, role=:role';
        $args = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ];

        $this->run($sql, $args);
    }




    //INSERT INTO `users`(`username`, `password`, `role`) VALUES ('Giovanni','123','admin')
}
