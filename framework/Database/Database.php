<?php

namespace Framework\Database;

use Framework\Database\Exception\InvalidDatabaseException;

class Database
{

    private $database;

    public function __construct($host, $username, $password, $database)
    {

        try {
            $this->database = new \PDO("mysql:host={$host};dbname={$database}", $username, $password);
            $this->database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            
        } catch (\PDOException $e) {
            throw new InvalidDatabaseException($e->getMessage());
        } 

    }

    /**
     * Get the value of database
     */ 
    public function getDatabase()
    {
        return $this->database;
    }


}