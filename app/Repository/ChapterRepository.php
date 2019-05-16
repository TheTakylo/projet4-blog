<?php

namespace App\Repository;

use App\Entity\Chapter;
use Framework\Database\Repository\AbstractRepository;

class ChapterRepository extends AbstractRepository
{
    protected function getEntity(): string
    {
        return Chapter::class;
    }
}