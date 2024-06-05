<?php
class Database
{
    private $conn;

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
            throw new Exception("Error al conectar a la base de datos: {$e->getMessage()}");
        }
    }
    /**
     * Consulta base de datos 
     * 
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */

    function query($query, $params = [])
    {
        try {

            $stmt = $this->conn->prepare($query);
            foreach($params as $param => $value){
                    $stmt->bindValue(':'.$param, $value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {

            throw new Exception("la consulta ha fallado: {$e->getMessage()}");
        }
    }
}
