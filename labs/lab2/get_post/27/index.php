<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 27</title>
</head>
<body>
    <h1>Задание 27</h1>
    <p>GET.Пусть с помощью GET-запроса отправляется число. Оно может быть или 1, или 2.<br>
    Сделайте так, чтобы если передано 1 - на экран вывелось слово 'привет', а если 2 - то слово 'пока'.</p>
    <form method="GET">
        <label for="number">
            Введите число 1 или число 2:
            <input type="number" name="number">
        </label>
        <input type="submit">
    </form>
    <?php
        $number=1;
        if (isset($_GET["number"])) $number=$_GET["number"];
        if ($number==1) echo "привет";
        else if ($number==2) echo "пока";
        else echo "надо ввести число 1 или 2. попробуйте ещё раз:)";
    ?>
</body>
</html>