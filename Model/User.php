<?php namespace Model;

use Core\Database;

// TODO REWRITE USER CLASS
class User {
    public $id;
    public $username;
    public $role;
    public $createdAt;

    private $email;
    private $password;
    private $db;

    public function __construct($id = null)
    {
        $this->db = new Database();

        if (isset($_SESSION['userid'])) {
            $query = $this->db->run('SELECT * FROM users WHERE id=:id', ['id' => $_SESSION['userid']]);
        }
    }

    public function login()
    {

    }

    public function logout() {}

    public function create()
    {
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $args = [
            'username' => $this->username,
            'email' => strtolower($this->email),
            'password' => password_hash($this->password, PASSWORD_BCRYPT),
        ];
        $this->db->run($sql, $args);
        // maybe return something?
    }

    public function emailExists($email) 
    {
        $query = $this->db->run('SELECT email FROM users WHERE email=:email', ['email'=>$email])->fetch();
        if ($query) {
            return true;
        }
        return false;
    }

}