<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 25</title>
</head>
<body>
    <h1>Задание 25</h1>
    <form mathod="GET">
        <label for="number">
            Введите число:
            <input type="number" name="number">
            <input type="submit">
        </label>
    </form>
    <p>GET. Отправьте с помощью GET-запроса число. Выведите его на экран квадрат этого числа.</p>
    <?php
        $number=0;
        if (isset($_GET["number"])) $number = $_GET["number"];
        echo "<br>Число - $number";
        echo "<br>Квадрат числа - ". $number**2;
    ?>  
</body>
</html>