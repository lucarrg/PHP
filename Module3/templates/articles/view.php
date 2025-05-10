<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?=  $article->getAuthor()->getNickname() ?></p>
    <a href="articles/<?=$article->getId()?>/edit">Редактировать статью<br></a>
    <a href="articles/<?=$article->getId()?>/delete">Удалить статью</a>

    <form method="post" action="/PHP/Module3/www/articles/<?=$article->getId()?>/comments">
        <label for="text">Комментарий</label>
        <textarea name="text" id="text"></textarea>
        <button type="submit">Отправить</button>
    </form>

    <div>
        <?php foreach ($comments as $comment): ?>
        <p><?= $comment->getText()?></p>
        <a href="articles/<?=$article->getId()?>/comments/<?=$comment->getId()?>/edit">Редактировать комментарий</a>
        <hr>
        <?php endforeach; ?>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>
