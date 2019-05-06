<?php

namespace App\Model;

use Framework\Database\Model;
use Framework\Helpers\TextHelper;

class Chapters extends Model
{

    private function findWithComments($limit = false, $chapter_id = false)
    {
        $values = [];

        if($limit) {
            $values[':limit'] = (int) $limit;
        }

        if($chapter_id) {
            $values[':chapter_id'] = $chapter_id;
        }
        
        $limit = ($limit) ? " LIMIT {$limit} " : "";
        $where = ($chapter_id) ? " WHERE cp.id = :chapter_id " : "";

        $query = "SELECT a.*, 
        COUNT(b.id) as comments_count 
        FROM chapters AS a 
        LEFT JOIN comments
        AS b {$where} ON a.id = b.chapter_id
        {$limit} 
        ";


        $query  = $this->db->prepare($query);
        $query->execute($values);

        return $query->fetchAll();
    }

    public function all()
    {
        return $this->findWithComments();
    }

    public function selectForHome()
    {
        return $this->findWithComments(3);
    }

    public function findBy(string $row, $value)
    {
        $query = $this->db->prepare("SELECT * FROM chapters WHERE {$row} = :parameter  ");
        $query->execute([':parameter' => $value]);

        return $query->fetch();
    }

    public function delete(int $id)
    {
        $query = $this->db->prepare("DELETE FROM chapters WHERE id = :id");

        return $query->execute(['id' => $id]);
    }

    public function insert(string $title, string $content)
    {
        $query = $this->db->prepare('INSERT INTO chapters (title, content, created_at, slug) VALUES (:title, :content, :created_at, :slug)');

        return $query->execute([
            ':title' => $title,
            ':content' => $content,
            ':created_at' => date('Y-m-d H:i:s'),
            ':slug' => TextHelper::slug($title)
        ]);
    }

    public function update(string $title, string $content, int $id)
    {
        $query = $this->db->prepare('UPDATE chapters SET title = :title, content = :content, updated_at = :updated_at, slug = :slug WHERE id = :id ');

        return $query->execute([
            ':title' => $title,
            ':content' => $content,
            ':updated_at' => date('Y-m-d H:i:s'),
            ':slug' => TextHelper::slug($title),
            ':id' => $id
        ]);
    }

}