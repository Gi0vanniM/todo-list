<?php namespace Model;

use Core\Core;
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
    public function __construct($id = null, $session = false)
    {
        $this->db = new Database();
        // get user data if id is given
        if (!$session && $id) {
            $this->getUser($id);
        } 
        // if session is true and $_SESSION has a userid, 
        // it will get the user and set $loggedIn to true
        if ($session && isset($_SESSION['userid'])) {
            $this->getUser($_SESSION['userid']);
            $this->loggedIn = true;
        }
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

            // give user standard role if it didnt already
            if (!$this->role) {
                $this->setRole(1);
            }

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
     * @return boolean
     */
    public function register($username = null, $email = null, $password = null)
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

        return $this->db->run($sql, $args);
    }

    /**
     * will check if given email exists as user
     *
     * @param String $email
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
     * will check if given id exists as user
     *
     * @param Int $id
     * @return boolean
     */
    public function userExists($id)
    {
        $query = $this->db->run('SELECT id FROM users WHERE id=:id', ['id' => $id])->fetch();
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
        // TODO: sanitize inputs
        $query = $this->db->run(
        'SELECT users.*, roles.role_name, roles.id as role_id
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

    /**
     * get all users in database including their role
     *
     * @return array
     */
    public static function getAllUsers()
    {
        return (new Database)->run(
            'SELECT users.*, roles.role_name, roles.id as role_id
            FROM users
            LEFT JOIN user_roles ON users.id=user_roles.user_id
            LEFT JOIN roles ON user_roles.role_id=roles.id'
        )->fetchAll();
    }
    
    /**
     * If user is not logged in, redirect to login page.
     * By default the current url gets saved 
     * (only if user not logged in) unless $tempUrl is set to false.
     *
     * @param [type] $redirect
     * @return void
     */
    public function authUser($tempUrl = true)
    {
        // check if user is logged in
        if (!$this->loggedIn) {
            if ($tempUrl) {
                // temporarily save url
                Helper::tempSaveUrl();
            }
            // redirect to login page
            return header(Core::$header . '/login');
        }
    }

    /**
     * set a user's role
     *
     * @param [type] $roleId
     * @return void
     */
    public function setRole($roleId)
    {
        if (!$roleId) {
            return false;
        }
        if ($this->role) {
            $sql = 'UPDATE user_roles SET role_id=:role_id WHERE user_id=:user_id';
        } else {
            $sql = 'INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)';
        }
        $args = [
            'user_id' => $this->id,
            'role_id' => $roleId,
        ];
        if ($this->db->run($sql, $args)) {
            return true;
        }
        return false;
    }

    public static function getAllRoles()
    {
        return (new Database())->run(
            'SELECT * FROM roles'
        )->fetchAll();
    }

}