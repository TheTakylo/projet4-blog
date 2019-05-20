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
}