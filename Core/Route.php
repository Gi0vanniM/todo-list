<?php

namespace Core;

class Route
{
    private $request;

    public function route()
    {
        $this->request = new Request();
        $this->parse($this->request->url, $this->request);
        $controller = $this->loadController();

        if (method_exists($controller, $this->request->action)) {
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        } else {
            exit("<h1 style='color: red;'>An error has occured. Could not find ". ($this->request->controller)."</h1>");
        }
    }

    public function parse($url, $request)
    {
        $url = trim($url);
        $url = strstr($url, '?', true) ?: $url;

        // TODO: rework this

        if ($url == APP_URL || $url == APP_URL . '/') {
            $request->controller = 'Home';
            $request->action = 'index';
            $request->params = [];
        } else {
            $urlParams = explode('/', $url);
            $urlParams = array_slice($urlParams, (VHOST) ? 1 : 2);
            $request->controller = ucfirst($urlParams[0] ?? 'Home');
            $request->action = $urlParams[1] ?? 'index';
            $request->params = array_slice($urlParams, 2);
        }
    }

    public function loadController()
    {
        // this bit has to be a bit static in order to work in the way I want it to
        switch ($this->request->controller) {
            case 'Login':
            case 'Register':
            case 'Logout':
                // /login /register and /logout will be done in the AuthController
                $class = 'Controllers\\Auth\\' . ucfirst($this->request->controller);
                include ROOT . 'Controllers/AuthController.php';
                return new $class();
                break;
            default:
                // other controllers
                $class = 'Controllers\\' . ucfirst($this->request->controller) . 'Controller';
            break;
        }
        // get the complete classname with namespace
        // check if class exists
        if (class_exists($class)) {
            // autoload.php will autoload the class
            $controller = new $class();
            // return the controller (class)
            return $controller;
        }
        return $this->request->controller;
    }
}
