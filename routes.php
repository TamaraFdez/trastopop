<?php 
//registramos las rutas del router
$router->get('/', 'HomeController@index');
$router->get('/trastos', 'TrastoController@index');
$router->get('/trasto/create', 'TrastoController@create');
$router->get('/trasto/{id}', "TrastoController@show");
// $router->get('/','controllers/home.php');
// $router->get('/trastos','controllers/trastos/show.php');
// $router->get('/trastos','controllers/trastos/index.php');
// $router->get('/trastos/create','controllers/trastos/create.php');

