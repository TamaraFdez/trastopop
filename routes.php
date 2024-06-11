<?php 
//registramos las rutas del router
$router->get('/', "HomeController@index");
$router->get('/trastos', "TrastoController@index");
$router->get('/trasto/create', "TrastoController@create",['auth']);
$router->get('/trasto/edit/{id}', "TrastoController@edit",['auth']);
$router->get('/trasto/{id}', "TrastoController@show");

$router->post('/trasto', "TrastoController@store",['auth']);
$router->put('/trasto/{id}', "TrastoController@update",['auth']);
$router->delete('/trasto/{id}', "TrastoController@delete",['auth']);

//rutas para la autenticación de los usuarios
$router->get('/auth/register', 'UserController@create',['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);

$router->post('/auth/create', 'UserController@store',['guest']);
$router->post('/auth/logout', 'UserController@logout',['auth']);

$router->post('/auth/login', 'UserController@authenticate',['guest']);




