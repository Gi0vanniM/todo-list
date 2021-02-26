<?php

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require(ROOT . 'Helpers/autoload.php');
require(ROOT . 'config.php');

$route = new Core\Route();
$route->route();
