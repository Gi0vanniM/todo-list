<?php

namespace Core;

use Model\User;

class Core
{
    public static $header = "location: //" . APP_URL;

    /**
     * display the requested view with the needed data
     *
     * @param [type] $file
     * @param [type] $data
     * @return view
     */
    public static function view($file, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        $_CurrentUser = new User(session: true);

        require(ROOT . 'views/templates/header.php');
        require(ROOT . 'views/' . $file . '.php');
        require(ROOT . 'views/templates/footer.php');
    }
}
