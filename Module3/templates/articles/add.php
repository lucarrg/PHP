<?php include __DIR__ . '/../header.php'; ?>
<?php if (!empty($error)): ?>
    <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
<?php endif; ?>
    <h1>Новая статья</h1>
    <form method="POST" class="form">
        <label for="name" class="form-label">
            Название
            <input name="name" id="name" class="form-input">
        </label>
        <label for="text" class="form-label">
            Текст
            <textarea name="text" id="text" class="form-input"></textarea>
        </label>
        <button class="form-button" type="submit">Создать</button>
    </form>
<?php include __DIR__ . '/../footer.php'; ?>
