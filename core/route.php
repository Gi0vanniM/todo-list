<?php
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
            exit("<h1 style='color: red;'>An error has occured</h1>");
        }
    }

    public function parse($url, $request)
    {
        $url = trim($url);

        // TODO: rework this

        if ($url == "/todo-list/") {
            $request->controller = 'home';
            $request->action = 'index';
            $request->params = [];
        } else {
            $urlParams = explode('/', $url);
            $urlParams = array_slice($urlParams, 2);
            $request->controller = $urlParams[0] ?? 'home';
            $request->action = $urlParams[1] ?? 'index';
            $request->params = array_slice($urlParams, 2);
        }
    }

    public function loadController()
    {
        $name = $this->request->controller . 'Controller';
        $file = ROOT . 'controllers/' . $name . '.php';
        require($file);
        $controller = new $name();
        return $controller;
    }
}
