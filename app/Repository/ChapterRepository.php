<?php

namespace App\Repository;

use App\Entity\Chapter;
use Framework\Database\Repository\AbstractRepository;
use Framework\Helpers\TextHelper;

class ChapterRepository extends AbstractRepository
{
    
    static $pagination = [
        'maxElements' => 8
    ];
    
    protected function getEntity(): string
    {
        return Chapter::class;
    }
    
    private function getOffset($pageNumber)
    {
        return ($pageNumber - 1) * self::getMaxElements();
    }
    
    public function findAllWithNbComments($pageNumber = null)
    {
        $limit = ($pageNumber) ? 'LIMIT :p_offset, :p_limit' : ' LIMIT 3 ';
        

        $query = "SELECT chapters.*, COUNT(distinct comments.id) AS comments_count
        FROM chapters 
        LEFT JOIN comments ON comments.chapter_id = chapters.id
        GROUP BY chapters.id 
        ORDER BY chapters.id DESC {$limit}";
        
        $query = $this->db->prepare($query);
        
        $query->bindValue(':p_limit', self::getMaxElements(), \PDO::PARAM_INT);
        $query->bindValue(':p_offset', $this->getOffset($pageNumber), \PDO::PARAM_INT);
        
        $query->execute();
        
        return $this->hydrateEntities($query->fetchAll());
        
    }
    
    public function update($title, $content, $id): bool
    {
        $slug = TextHelper::slug($title);

        $query = "UPDATE chapters SET title=:title, content=:content, slug=:slug, updated_at=:updated_at WHERE id=:id";
        $query = $this->db->prepare($query);

        return $query->execute([
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $id
        ]);
    }

    static function getMaxElements(): int
    {
        return (int) self::$pagination['maxElements'];
    }
    
}