<?php

/**
 * User: Mamadou Sarr
 * Date: 25/12/2020
 * Time: 21:36
 */

namespace App\Core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(): ?string
    {

        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return 'Not Found';
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->baseController = new $callback[0]();
            $callback[0] = Application::$app->baseController;
        }
        return $callback($this->request, $this->response);
    }

    public function renderView(string $view, array $params = []): string
    {
        //$layoutContent = $this-
        $layout = Application::$app->baseController->layout;
        $viewContent = $this->renderPage($view, $params);
        View::setContent($viewContent);
        ob_start();
        include_once Application::$ROOT_PATH . '/views/layouts/' . $layout . '.tpl.php';
        return ob_get_clean();
        //return strtr($layoutContent, ['{{content}}' => $viewContent]);
    }

    public function renderPage($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_PATH . '/views/' . $view . '.gis.php';
        return ob_get_clean();
    }

    /*protected function layoutContent()
    {
        $layout = Application::$app->baseController->layout;
        ob_start();
        include_once Application::$ROOT_PATH . '/views/layouts/' . $layout . '.tpl.php';
        return ob_get_clean();
    }*/
}
