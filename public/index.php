<?php

echo 'index.php';

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require(ROOT . 'config.php');
require(ROOT . 'core/route.php');
require(ROOT . 'core/request.php');

$route = new Route();
$route->route();
