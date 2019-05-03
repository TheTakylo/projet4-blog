<?php

namespace App\Model;

use Framework\Database\Model;

class Chapters extends Model
{

    public function all()
    {
        return $this->db->query('SELECT * FROM chapters ORDER BY id DESC')->fetchAll();
    }

}