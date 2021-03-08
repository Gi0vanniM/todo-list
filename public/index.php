<?php

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require(ROOT . 'config.php');
require(ROOT . 'Helpers/autoload.php');

// start session if there isn't one
if (!isset($_SESSION)) {
    session_start();
}

$route = new Core\Route();
$route->route();
