<?php

namespace App\Model;

use Framework\Database\Model;

class Chapters extends Model
{

    public function all()
    {
        return $this->db->query('SELECT * FROM chapters ORDER BY id DESC')->fetchAll();
    }

    public function selectForHome()
    {
        return $this->db->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 3')->fetchAll();
    }

    public function find(string $slug)
    {
        $query = $this->db->prepare('SELECT * FROM chapters WHERE slug = :slug ');
        $query->execute([':slug' => $slug]);

        return $query->fetch();
    }

}