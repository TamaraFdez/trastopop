<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$query = 'SELECT * FROM trastos LIMIT 3';
$stmt = $db->conn->prepare($query);
$stmt->execute();
$trastos = $stmt->fetchAll(); 


//Llamar al modelo para obtener los datos
// pasarlos a la vista home y cargar la vista

loadView('home', [
    'trastos' => $trastos
]);