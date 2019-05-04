<?php

namespace Framework\Database;

use Framework\Configuration\Store;

abstract class Model
{
    
    protected $db;
    
    public function __construct()
    {
        $this->db = Store::getInstance()->getDatabase();
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