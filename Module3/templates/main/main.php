<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($articles as $article): ?>
    <h2><a href="/PHP/Module3/www/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getText() ?></p>
    <hr>
<?php endforeach; ?>
<a href="articles/add">Добавить новую статью</a>
<?php include __DIR__ . '/../footer.php'; ?>