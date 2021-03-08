<?php

namespace Core;

class Request
{
    public $url;

    public function __construct()
    {
        $host = (VHOST) ? $_SERVER['SERVER_NAME'] : '';
        $this->url = $host . $_SERVER["REQUEST_URI"];
    }
}
