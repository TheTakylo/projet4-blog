<?php

namespace Framework\Database;

use Framework\Database\Exception\InvalidDatabaseException;

class Database
{

    private $database;

    public function __construct(array $config)
    {
        try {
            $this->database = new \PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
            $this->database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            
        } catch (\PDOException $e) {
            throw new InvalidDatabaseException($e->getMessage());
        } 
    }
    
    public function getConnection()
    {
        return $this->database;
    }

}