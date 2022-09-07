<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = array();

    public function __construct($req, $res)
    {
        $this->request = $req;
        $this->response = $res;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback == false) {
            $this->response->setStatusCode(404);
            $layout = $this->layoutContent();
            $view = $this->renderOnlyView('notfound', []);
            return str_replace("{{Content}}", $view, $layout);
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            return call_user_func($callback, $this->request);
        }
        return call_user_func($callback);
    }

    public function renderView($view, $params = [])
    {
        $layout = $this->layoutContent();
        $view  = $this->renderOnlyView($view, $params);
        return str_replace("{{Content}}", $view, $layout);
    }

    protected function layoutContent()
    {
        ob_start();
        include Application::$ROOT_DIR . "/views/layout/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
