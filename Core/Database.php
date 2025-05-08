<?php
namespace Core;

use PDO;

class Database {
    
    private $connection;

    public function __construct($config)
    {   
        $dns = array_slice($config, 0, 3);
        $dns = 'mysql:' . http_build_query($dns, '', ';');

        $this->connection = new PDO($dns, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($sql, $args = null) 
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}


