<?php namespace Model;

use Core\Database;
use Helpers\Helper;

class User {
    public $id;
    public $username;
    public $role;
    public $created_at;

    public $loggedIn = false;

    private $email;
    private $password;
    private $db;

    /**
     * Class constructor
     *
     * @param [type] $id
     */
    public function __construct($id = null)
    {
        $this->db = new Database();

        // TODO
        // if (isset($_SESSION['userid'])) {
        //     $query = $this->db->run('SELECT * FROM users WHERE id=:id', ['id' => $_SESSION['userid']]);
        // }
    }

    /**
     * Login
     * 
     * Login a user
     *
     * @param [type] $loginEmail
     * @param [type] $loginPassword
     * @return boolean
     */
    public function login($loginEmail, $loginPassword)
    {
        $loginEmail = strtolower(Helper::sanitize($loginEmail));
        $loginPassword = Helper::sanitize($loginPassword);

        if (!$this->emailExists($loginEmail)) {
            return false;
        }

        $this->getUserByEmail($loginEmail);

        $pass = password_verify($loginPassword, $this->password);

        if ($loginEmail == $this->email && $pass) {
            $_SESSION['userid'] = $this->id;
            $_SESSION['username'] = $this->username;
            $_SESSION['email'] = $this->email;
            $_SESSION['token'] = '1234';
            $this->loggedIn = true;

            return true;
        }
        

    }

    /**
     * Logout
     * 
     * Logout a user
     *
     * @return void
     */
    public function logout() 
    {
        // TODO
    }

    /**
     * Register
     * 
     * Register a new user
     *
     * @param [type] $username
     * @param [type] $email
     * @param [type] $password
     * @param string $role
     * @return boolean
     */
    public function register($username = null, $email = null, $password = null, $role = 'user')
    {
        // check if all needed variables are there, role is not necessary
        if (!$username || !$email || !$password) {
            return false;
        }

        // check if email already exists
        // if it does, exit
        if ($this->emailExists($email)) {
            return false;
        }

        $this->username = Helper::sanitize($username);
        $this->email = Helper::sanitize($email);
        $this->password = Helper::sanitize($password);
        $this->role = Helper::sanitize($role);

        if ($this->create()) {
            return true;
        }

        return false;
    }

    /**
     * Create
     * 
     * Create the user in the database
     *
     * @return void
     */
    public function create()
    {
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $args = [
            'username' => $this->username,
            'email' => strtolower($this->email),
            'password' => password_hash($this->password, PASSWORD_BCRYPT),
        ];

        // TODO: also save a role

        return $this->db->run($sql, $args);
    }

    /**
     * will check if given email exists as user
     *
     * @param [type] $email
     * @return boolean
     */
    public function emailExists($email) 
    {
        $query = $this->db->run('SELECT email FROM users WHERE email=:email', ['email'=>$email])->fetch();
        if ($query) {
            return true;
        }
        return false;
    }

    /**
     * getUserByEmail
     * 
     * get user by email, if return is set to true, it will return the user class.
     *
     * @param [type] $email
     * @return void
     */
    public function getUserByEmail($email, $return = false) 
    {
        $query = $this->db->run('SELECT users.* FROM users WHERE email=:email', ['email' => $email])->fetch();
        $this->getUser($query->id, $return);
    }

    /**
     * getUser
     * 
     * get a user by id including role
     * if return is set to true it will return the User class
     *
     * @param [type] $id
     * @param boolean $return
     * @return void|User
     */
    public function getUser($id, $return = false)
    {
        $query = $this->db->run(
        'SELECT users.*, roles.role_name 
        FROM users 
        LEFT JOIN user_roles ON users.id=user_roles.user_id 
        LEFT JOIN roles ON user_roles.role_id=roles.id 
        WHERE users.id=:id', 
        ['id' => $id])->fetch();

        $this->id = $query->id;
        $this->username = $query->username;
        $this->email = $query->email;
        $this->password = $query->password;
        $this->role = $query->role_name;
        $this->created_at = $query->created_at;

        if ($return) {
            return $this;
        }
    }

}