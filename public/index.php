<?php

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require(ROOT . 'config.php');
require(ROOT . 'core/core.php');
require(ROOT . 'core/route.php');
require(ROOT . 'core/request.php');
require(ROOT . 'helpers/helper.php');

$route = new Route();
$route->route();
