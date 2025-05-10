<?php include __DIR__ . '/../header.php'; ?>
<?php if (!empty($error)): ?>
    <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
<?php endif; ?>
    <h1><?= $article->getName() ?></h1>
    <form method="POST" class="form">
        <label for="name" class="form-label">
            Новое название
            <input name="name" id="name" class="form-input" value="<?= $article->getName() ?>">
        </label>
        <label for="text" class="form-label">
            Новый текст
            <textarea name="text" id="text" class="form-input"><?= $article->getText() ?></textarea>
        </label>
        <button class="form-button" type="submit">Редактировать</button>
    </form>
<?php include __DIR__ . '/../footer.php'; ?>
