<?php 
require '../helpers.php';
require basePath('Database.php');


require basePath('Router.php');
$router = new Router();
//registramos las rutas
$router->get('/','controllers/home.php');
$router->get('/trastos','controllers/trastos/index.php');
$router->get('/trastos/create','controllers/trastos/create.php');

//mirar la uri de la peticion http
$uri = $_SERVER['REQUEST_URI'];
//mirar el metodo
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri,$method);



