<?php
use Core\Database;
$config = require basePath('config/db.php');
$db = new Database($config);



$trastos = $db->query('SELECT * FROM trastos LIMIT 3')->fetchAll();


//Llamar al modelo para obtener los datos
// pasarlos a la vista home y cargar la vista

loadView('home', [
    'trastos' => $trastos
]);