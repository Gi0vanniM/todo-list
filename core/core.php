<?php
class Core
{
    public static function view($file, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        require(ROOT . 'views/templates/header.php');
        require(ROOT . 'views/' . $file . '.php');
        require(ROOT . 'views/templates/footer.php');
    }
}
