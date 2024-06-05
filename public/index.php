<?php 

require __DIR__.'/../vendor/autoload.php';
require '../helpers.php';
// spl_autoload_register(function($class){
//     $path = basePath('Core/'.$class.'.php');
//     if(file_exists($path)){
//         require $path;
//     }
// });
use Core\Router;
$router = new Core\Router();



//registramos las rutas
$routes = require basePath('routes.php');

//mirar la uri de la peticion http
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//mirar el metodo


$router->route($uri);



