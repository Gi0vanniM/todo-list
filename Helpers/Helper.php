<?php

namespace Helpers;
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

    public static function sanitize($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }

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
}
