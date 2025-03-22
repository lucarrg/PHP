<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEWORK 1</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="header__wrapper wrapper">
            <img src="/PHP/media/logo.png" alt="Логотип" class="header__logo">
            <h1 class="header__title">Feedback Form</h1>
        </div>
    </header>
    <main class="main">
        <div class="wrapper">
            <h1>Результат работы функции get_headers</h1>
            <textarea rows="20" cols="100">
                <?php
                    $url = "https://httpbin.org";
                    $headers = get_headers($url);
                    foreach ($headers as $header) {
                        echo $header . "\n";
                    }
                ?>
            </textarea>
        </div>
    </main>
    <footer class="footer">
        <div class="wrapper">
            <p class="footer__text">Задание для самостоятельной работы. </p>
            <p class="footer__text">
                Собрать сайт из двух страниц.<br>
                1 страница: Сверстать форму обратной связи. Отправку формы осуществить на URL: https://httpbin.org/post. Добавить кнопку для перехода на 2 страницу.<br>
                2 страница: вывести на страницу результат работы функции get_headers. Загрузить код в удаленный репозиторий. Залить на хостинг.
            </p>
        </div>
    </footer>
</body>
</html>