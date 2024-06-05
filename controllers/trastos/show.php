<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? '';
$params = [
    'id' => $id
];
$trasto = $db->query('SELECT * FROM trastos WHERE id = :id', $params)->fetch();


//Llamar al modelo para obtener los datos
// pasarlos a la vista home y cargar la vista

loadView('trastos/show', [
    'trasto' => $trasto
]);