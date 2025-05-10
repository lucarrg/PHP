<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;
use MyProject\Services\Db;

class Comment extends ActiveRecordEntity
{
    protected $text;
    protected $authorId;
    protected $articleId;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return `comments`;
    }

    public function setText(string $text): void 
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function add(array $commentData, int $articleId): void 
    {
        $this->setText($commentData['text']);
        $this->articleId = $articleId;
        $this->authorId = 1;
        $this->save();
    }

    public function edit(array $commentData): void 
    {
        if (empty($commentData['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $this->setText($commentData['text']);
        $this->save();
    }

    public static function findByArticleId(int $articleId): array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `article_id` = :articleId;',
            [':articleId' => $articleId],
            static::class
        );
    }
}