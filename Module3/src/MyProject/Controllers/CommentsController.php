<?php
namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\View\View;
use MyProject\Models\Comments\Comment;

class CommentsController
{
    /** @var View */
    protected $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function add(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        $comment = new Comment;
        if (!empty($_POST)){
            $comment->add($_POST, $articleId);
            header('Location: /PHP/Module3/www/articles/' . $articleId . '#comment' . $comment->getId());
        }

    }

    public function edit(int $commentId): void
    {
        /** @var Comment $comment */
        $comment = Comment::getById($commentId);

        if ($comment === null) {
            throw new NotFoundException();
        }

        if (!empty($_POST)) {
            try{
                $comment->edit($_POST);
                header('Location: /PHP/Module3/www/articles/' . $comment->getArticleId());
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('comments/edit.php', ['comment' => $comment, 'error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('comments/edit.php', ['comment' => $comment]);
    }
}