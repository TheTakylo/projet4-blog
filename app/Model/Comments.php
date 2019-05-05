<?php

namespace App\Model;

use Framework\Database\Model;

class Comments extends Model
{

    /**
     * Récupére les commentaires d'un chapitre
     * 
     * @var int $chapter
     */
    public function getAll(int $chapter_id)
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE chapter_id = :id');

        $query->execute([
            ':id' => $chapter_id
        ]);
        
        return $query->fetchAll();
    }

    public function insert($email, $pseudo, $content, $chapter_id)
    {
        $query = $this->db->prepare("INSERT INTO comments (email, pseudo, content, created_at, chapter_id) VALUES (:email, :pseudo, :content, :created_at, :chapter_id) ");

        return $query->execute([
            ':email' => md5($email),
            ':pseudo' => $pseudo,
            ':content' => $content,
            ':created_at' => date('Y-m-d H:i:s'),
            ':chapter_id' => $chapter_id,
        ]);
    }

}