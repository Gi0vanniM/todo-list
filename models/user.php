<?php
require(ROOT . 'core/database.php');
class User extends DB
{
    public function getUsers()
    {
        return $this->run('SELECT * FROM users');
    }

    public function createUser($name, $pass, $role)
    {
        $sql = 'INSERT INTO users name=:name, password=:pass, role=:role';
        $args = [
            'name' => $name,
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
            'role' => $role,
        ];

        $this->run($sql, $args);
    }


    //INSERT INTO `users`(`name`, `password`, `role`) VALUES ('Giovanni','123','admin')
}
