<?php

namespace Helpers;

use Core\Database;

class Helper
{
    /**
     * find specific object in object array
     * returns false if it couldn't find anything
     *
     * @param [type] $array
     * @param [type] $searchKey
     * @param [type] $searchValue
     * @return object
     */
    public static function find($array, $searchKey, $searchValue)
    {
        foreach ($array as $sub) {
            if ($sub->$searchKey === $searchValue) {
                return $sub;
            }
        }
        return false;
    }

    /**
     * this function will sanitize $data
     * with trim(), htmlspecialchars() 
     * and stripcslashes() function
     *
     * @param [type] $data
     * @return string
     */
    public static function sanitize($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }

    /**
     * this will return an alert div
     *
     * @return string
     */
    public static function alert()
    {
        if (isset($_GET['error'])) {

            $message = '';

            switch ($_GET['error']) {
                case 'pass':
                    $message = 'Incorrect password';
                    break;
                case 'login':
                    $message = 'Incorrected e-mail or password';
                    break;
                
                default:
                    $message = 'Something went wrong';
                    break;
            }
            return <<<HTML
                <div class="alert alert-danger" role="alert">
                        $message
                </div> 
                HTML;
        }
    }

    /**
     * check if request method is post
     * and also check if $_POST contains a variable if $isset is given
     *
     * @param [type] $isset
     * @return boolean
     */
    public static function isPostSet($isset = null)
    {
        // check if request method is not post
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
            // check if $isset is given
        } elseif (isset($isset)) {
            // check if $_POST contains $isset
            if (!isset($_POST[$isset])) {
                echo '$isset';
                return false;
            }
        }
        return true;
        
    }

    /**
     * Temporarily save current url.
     * This will be used so that when the user gets 
     * redirected to the login page, he will be sent 
     * back to where he was after successfully logging in.
     *
     * @return void
     */
    public static function tempSaveUrl() 
    {
        $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the temporarily saved url.
     * By default it will also delete 
     * the variable unless $delete is set to false.
     *
     * @param boolean $delete
     * @return void
     */
    public static function currentPage($delete = true)
    {
        // get the full url
        $currentPage = $_SESSION['current_page'];
        // delete the temporary url (by default)
        if ($delete) {
            unset($_SESSION['current_page']);
        }
        return $currentPage;
    }

    /**
     * get all the statuses
     *
     * @return Status
     */
    public static function getAllStatus()
    {
        return (new Database)->run('SELECT * FROM status')->fetchAll();
    }

}
