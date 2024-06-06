<?php 
//registramos las rutas del router
$router->get('/', "HomeController@index");
$router->get('/trastos', "TrastoController@index");
$router->get('/trasto/create', "TrastoController@create");
$router->get('/trasto/edit/{id}', "TrastoController@edit");
$router->get('/trasto/{id}', "TrastoController@show");

$router->post('/trasto', "TrastoController@store");
$router->put('/trasto/{id}', "TrastoController@update");
$router->delete('/trasto/{id}', "TrastoController@delete");


// $router->get('/','controllers/home.php');
// $router->get('/trastos','controllers/trastos/show.php');
// $router->get('/trastos','controllers/trastos/index.php');
// $router->get('/trastos/create','controllers/trastos/create.php');

