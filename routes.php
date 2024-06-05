<?php 
//registramos las rutas del router
$router->get('/','controllers/home.php');
$router->get('/trastos','controllers/trastos/show.php');
$router->get('/trastos','controllers/trastos/index.php');
$router->get('/trastos/create','controllers/trastos/create.php');
