<?php

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require(ROOT . 'config.php');
require(ROOT . 'Helpers/autoload.php');

$route = new Core\Route();
$route->route();
