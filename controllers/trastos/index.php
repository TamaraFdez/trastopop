<?php


$config = require basePath('config/db.php');
$db = new Database($config);



$trastos = $db->query('SELECT * FROM trastos')->fetchAll();


//Llamar al modelo para obtener los datos
// pasarlos a la vista home y cargar la vista

loadView('trastos/index', [
    'trastos' => $trastos
]);
