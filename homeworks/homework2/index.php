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
            <form action="https://httpbin.org/post" class="main__form" method="post">
                <label for="name" class="main__label">
                    Имя пользователя
                    <input id="name" name="name" type="text" class="main__input">
                </label>
                <label for="email" class="main__label">
                    Email пользователя
                    <input class="main__input" type="email" name="email" id="email">
                </label>
                <label for="type_of_apeal" class="main__label">
                    Тип обращения
                    <select name="type_of_apeal" id="type_of_apeal" class="main__select">
                        <option value="0" class="main__option">--Не выбрано--</option>
                        <option value="1" class="main__option">Жалоба</option>
                        <option value="2" class="main__option">Предложение</option>
                        <option value="3" class="main__option">Благодарность</option>
                    </select>
                </label>
                <label for="text_of_apeal" class="main__label">
                    Текст обращения
                    <textarea name="text_of_apeal" id="text_of_apeal" class="main__textarea"></textarea>
                </label>
                <p class="main__label">
                    Вариант ответа
                    <label for="sms_answer" class="main__label">
                        <input type="checkbox" class="main__checkbox" name="sms_answer" id="sms_answer">
                        СМС
                    </label>
                    <label for="email_answer" class="main__label">
                        <input type="checkbox" class="main__checkbox" name="email_answer" id="email_answer">
                        Email
                    </label>
                </p>
                <button type="submit" class="main__button">
                    Отправить
                </button>
            </form>
            <a href="next.php" class="main__link">
                Перейти на следующую страницу
            </a>
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