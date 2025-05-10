<?php
namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Models\Comments\Comment;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\View\View;

class ArticlesController
{
    /** @var View */
    protected $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function show(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $comments = Comment::findByArticleId($articleId);

        $this->view->renderHtml('articles/view.php', ['article' => $article, 'comments' => $comments]);
    }

    public function edit(int $articleId): void
    {
        /** @var Article $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if (!empty($_POST)) {
            try{
                $article->edit($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['article' => $article, 'error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        $article = new Article;
        if (!empty($_POST)) {
            try{
                $article->add($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('articles/add.php', []);
    }

    public function delete(int $articleId): void 
    {
        $article = Article::getById($articleId);
        $article->delete();
        header('Location: /PHP/Module3/www/');
        exit();   
    }
}