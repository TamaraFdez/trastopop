<?php
namespace Core;

class Router
{
    protected $routes = [];

    function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }
    /**
     * Añade una ruta por GET
     * @param string $uri
     * @param string $controller
     * @return void
     */

    function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }
    /**
     * Añade una ruta por POST
     * @param string $uri
     * @param string $controller
     * @return void
     */

    function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }
    /**
     * Añade una ruta por PUT
     * @param string $uri
     * @param string $controller
     * @return void
     */

    function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Añade una ruta por DELETE
     * @param string $uri
     * @param string $controller
     * @return void
     */

    function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Carga la vista de error que corresponda
     *
     * @param integer $httpErrorCode
     * @return void
     */
    function error($httpErrorCode = 404)
    {
        http_response_code($httpErrorCode);
        loadView("error/$httpErrorCode");
        exit;
    }

    /**
     * Recibe una uri y un método y carga el contolador
     * correspondiente
     *
     * @param string $uri
     * @param string $method
     * @return void
     */

    function route($uri, $method)
    {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require basePath("App/{$route['controller']}");
                return;
            }
        }
        $this->error(404);
    }
}
