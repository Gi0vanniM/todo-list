<?php 

namespace Controllers\Auth;

use Core\Core;
use Helpers\Helper;
use Model\User;

class Login 
{
    public function index()
    {
        return Core::view('auth/login', ['title' => 'Login']);
    }

    public function login()
    {
        if (isset($_POST['loginUser'])) {
            $emailSignin = strtolower(Helper::sanitize($_POST['email']));
            $passwordSignin = Helper::sanitize($_POST['password']);

            $user = new User();

            $user->login($emailSignin, $passwordSignin);

            // double check
            if ($user->loggedIn) {
                header("location: //" . APP_URL);
                exit;
            } else {
                header("location: //" . APP_URL . "/login?error=jeff");
            }

        } else {
            echo <<<HTML
            <div class="alert alert-ERROR" role="alert">
                <strong>Something has gone wrong.</strong>
            </div>
            HTML;
        }

        // header("location: //".APP_URL);
        // exit;
    }

}

class Register
{
    public function index()
    {
        return Core::view('auth/register', ['title' => 'Register']);
    }

    public function register()
    {
        if (isset($_POST['registerUser'])) {
            $username = Helper::sanitize($_POST['username']);
            $email = Helper::sanitize($_POST['email']);
            $password = Helper::sanitize($_POST['password']);
            $confirmPassword = Helper::sanitize($_POST['confirmpassword']);

            $user = new User();

            // check if email already exists
            // if so, stop the register process
            if ($user->emailExists($email)) {
                echo 'E-mail already registered';
                exit;
            }

            // if password is not the same as confirmpassword
            // exit out
            if ($password !== $confirmPassword) {
                echo 'Password not correct';
                exit;
            }

            if ($user->register($username, $email, $password)) {
                header("location: //" . APP_URL . "/login");
            }

        } else {
            echo <<<HTML
            <div class="alert alert-ERROR" role="alert">
                <strong>Something has gone wrong.</strong>
            </div>
            HTML;
        }

        exit;
    }
}

class Logout
{
    public function index()
    {
        session_destroy();
        header("location: //" . APP_URL);
        exit;
    }
}