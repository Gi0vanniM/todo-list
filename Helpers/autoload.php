<?php

spl_autoload_register(function ($class) {
    $file = ROOT . str_replace("\\", '/', $class) . '.php';
    if (!file_exists($file)) {
        return false;
    }
    include $file;
});
