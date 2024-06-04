<?php
class Database
{
    public $conn;

    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};post={$config['port']}; dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);

            echo "Conectado a la base de datos...";
        } catch (PDOException $e) {
            throw new Exception( "Error al conectar a la base de datos: {$e->getMessage()}");
        }
    }
}
