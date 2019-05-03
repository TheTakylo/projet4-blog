<?php

namespace Framework\Database;

abstract class Model
{
    
    protected $db;
    
    public function __construct()
    {
        global $database;

        $this->db = $database->getDatabase();
    }

    // protected function hydrate(array $data)
    // {
    //     foreach($data as $k => $v) {
    //         $method = 'set' . ucfirst($k);

    //         if(method_exists($this, $method)) {
    //             $this->$method($v);
    //         }
    //     }
    // }

}