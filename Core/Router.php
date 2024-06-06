<?php

namespace Core;

use App\Controllers\ErrorController;
use App\Controllers\HomeController;

class Router
{
    protected $routes = [];

    function registerRoute($method, $uri, $action)
    {
        list($controller, $controllerMethod) = explode('@', "$action");

        
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod

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
     * Recibe una uri y un método y carga el contolador
     * correspondiente
     *
     * @param string $uri
     * @param string $method
     * @return void
     */

     function route($uri)
     {
         //mirar el método
         $requestedMethod = $_SERVER['REQUEST_METHOD'];
 
         //mirar el _method que nos llega y lo guardamos en caso qu eno sea ni GET ni POST
         if ($requestedMethod === 'POST' && isset($_POST['_method'])) {
             $requestedMethod = strtoupper($_POST['_method']);
         }
         //Separamos la URI por sus segmentos
         $uriSegments = explode('/', trim($uri, '/'));
         // inspect($uriSegments);
 
         foreach ($this->routes as $route) {
 
             //Separamos la URI de la route registrada en segmantos
             $routeSegments = explode('/', trim($route['uri'], '/'));
             // inspect($routeSegments);
             if (
                 count($uriSegments) === count($routeSegments)  &&
                 strtoupper($route['method']) ===  $requestedMethod
             ) {
                 $params = [];
                 $match = true;
 
                 for ($i = 0; $i < count($uriSegments); $i++) {
                     //Si el segmento no encaja y no hay parametro salimos
                     if (
                         $routeSegments[$i] !== $uriSegments[$i] &&
                         !preg_match('/\{(.+?)\}/', $routeSegments[$i])
                     ) {
                         $match = false;
                         break;
                     }
 
                     //Miramos si se trata de un parametro y nos lo quedamos
                     if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                         $params[$matches[1]] = $uriSegments[$i];
                         // inspect($params);
                     }
                 }
 
                 if ($match) {
                     //Montamos la ruta del controller
                     $controller = 'App\\controllers\\' . $route['controller'];
                     $controllerMethod = $route['controllerMethod'];
 
                     //Creamos una intancia del controlador;
                     $controllerInstance = new $controller();
                     $controllerInstance->$controllerMethod($params);
                     return;
                 }
             }
         }
        ErrorController::notFount();
     }
 }