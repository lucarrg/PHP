<?php

namespace MyProject\Models\Articles;
 
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;

class Article extends ActiveRecordEntity
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;
    
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void 
    {
        $this->text = $text;
    }

    public function getAuthorId(): User
    {
        return $this->authorId;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function edit(array $articleData): void 
    {
        if (empty($articleData['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if (empty($articleData['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $this->setName($articleData['name']);
        $this->setText($articleData['text']);
        $this->save();
    }

    public function add(array $articleData): void 
    {
        if (empty($articleData['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if (empty($articleData['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $this->setName($articleData['name']);
        $this->setText($articleData['text']);
        $this->authorId = 1;
        $this->save();
    }

}
