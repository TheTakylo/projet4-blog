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

    public function findBy($row, $value)
    {
        $query = $this->db->prepare("SELECT * FROM chapters WHERE {$row} = :parameter ");
        $query->execute([':parameter' => $value]);

        return $query->fetch();
    }

    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM chapters WHERE id = :id");

        return $query->execute(['id' => $id]);
    }

}