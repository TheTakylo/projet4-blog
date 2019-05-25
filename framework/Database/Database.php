<?php

namespace Framework\Database;

use PDO;
use Framework\Database\Exception\InvalidDatabaseException;

class Database
{

    /** @var PDO $database */
    private $database;

    public function __construct(array $config)
    {
        try {
            $this->database = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
            $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            throw new InvalidDatabaseException($e->getMessage());
        } 
    }
    
    public function getConnection(): PDO
    {
        return $this->database;
    }

}