<?php

namespace App\Repository;

use App\Entity\Comment;
use Framework\Database\Repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{
    protected function getEntity(): string
    {
        return Comment::class;
    }

    /** @return Comment[] */
    public function findAllForAdmin(): array
    {
        $query = "SELECT comments.*, chapters.slug as chapter_slug, chapters.title as chapter_title
        FROM comments 
        LEFT JOIN chapters ON comments.chapter_id = chapters.id
        ORDER BY comments.id DESC";

        $query = $this->db->prepare($query);

        $query->execute();

        return $this->hydrateEntities($query->fetchAll());
    }

    public function setSpam($id)
    {
        $query = "UPDATE comments SET is_spam = 1 WHERE id=:id";

        $query = $this->db->prepare($query);

        return $query->execute(['id' => $id]);
    }
}