<?php

namespace App\Model;

use Framework\Database\Model;

class Comments extends Model
{

    public function all()
    {
        $query = $this->db->query("SELECT comments.*, chapters.title as chapter_title ,chapters.id as chapter_id, chapters.slug as chapter_slug FROM comments LEFT JOIN chapters ON comments.chapter_id = chapters.id");


        return $query->fetchAll();
    }
    
    /**
     * Récupére les commentaires d'un chapitre
     * 
     * @var int $chapter
     */
    public function getAll($chapter_id)
    {
        $query = $this->db->prepare("SELECT * FROM comments WHERE chapter_id = :id ORDER BY id DESC");

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

    public function markSpam($comment_id) {}

    public function deleteAll($chapter_id)
    {
        $query = $this->db->prepare("DELETE FROM comments WHERE chapter_id = :chapter_id");

        return $query->execute([
            'chapter_id' => $chapter_id
        ]);
    }

    public function delete($comment_id)
    {
        $query = $this->db->prepare("DELETE FROM comments WHERE id = :comment_id");

        return $query->execute([':comment_id' => $comment_id]);
    }

    public function getSpammed()
    {
        $query = $this->db->query("SELECT a.*, b.id as chapter_id, b.slug as chapter_slug, b.title as chapter_title
                        FROM comments AS a LEFT JOIN chapters AS b
                        ON a.chapter_id = b.id WHERE a.is_spam = 1");
        
        return $query->fetchAll();
    }

    public function hasSpam()
    {
        $query = $this->db->query("SELECT COUNT(comments.id) as total FROM comments WHERE is_spam = 1");

        return $query->fetch();
    }

}