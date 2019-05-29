<?php

namespace App\Entity;

use Framework\Database\Entity\AbstractEntity;
use Framework\Database\Entity\SchemaParameter;

class Comment extends AbstractEntity
{

    /** @var int */
    private $id;

    /** @var string */
    private $email;

    /** @var string */
    private $pseudo;

    /** @var string */
    private $content;

    /** @var bool */
    private $is_admin;

    /** @var bool */
    private $is_spam;

    /** @var bool */
    private $is_valid;

    /** @var \DateTime */
    private $created_at;

    /** @var int */
    private $chapter_id;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->is_spam = false;
        $this->is_admin = false;
        $this->is_valid = false;
    }

    public static function getTableName(): string
    {
        return 'comments';
    }

     /**
     * @return SchemaParameter[]
     */
    public static function getSchema(): array
    {
        return [
            new SchemaParameter('id', 'id', 'int'),
            new SchemaParameter('email', 'email', 'string'),
            new SchemaParameter('pseudo', 'pseudo', 'string'),
            new SchemaParameter('content', 'content', 'string'),
            new SchemaParameter('is_admin', 'is_admin', 'bool'),
            new SchemaParameter('is_spam', 'is_spam', 'bool'),
            new SchemaParameter('is_valid', 'is_valid', 'bool'),
            new SchemaParameter('created_at', 'created_at', 'datetime'),
            new SchemaParameter('chapter_id', 'chapter_id', 'int')
        ];
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of is_admin
     */ 
    public function getIs_admin(): bool
    {
        return (bool) $this->is_admin;
    }

    /**
     * Set the value of is_admin
     *
     * @return  self
     */ 
    public function setIs_admin(bool $is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    /**
     * Get the value of is_spam
     */ 
    public function getIs_spam(): bool
    {
        return (bool) $this->is_spam;
    }

    /**
     * Set the value of is_spam
     *
     * @return  self
     */ 
    public function setIs_spam(bool $is_spam)
    {
        $this->is_spam = $is_spam;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of chapter_id
     */ 
    public function getChapter_id()
    {
        return $this->chapter_id;
    }

    /**
     * Set the value of chapter_id
     *
     * @return  self
     */ 
    public function setChapter_id($chapter_id)
    {
        $this->chapter_id = $chapter_id;

        return $this;
    }

    /**
     * Get the value of is_valid
     */ 
    public function getIs_valid(): bool
    {
        return (bool) $this->is_valid;
    }

    /**
     * Set the value of is_valid
     *
     * @return  self
     */ 
    public function setIs_valid(bool $is_valid)
    {
        $this->is_valid = $is_valid;

        return $this;
    }
}