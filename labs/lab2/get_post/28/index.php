<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 28</title>
</head>
<body>
    <h1>Задание 28</h1>
    <p>GET. Отправьте с помощью GET-запроса два числа. Выведите его на экран сумму этих чисел.</p>
    <form method="GET">
        <label for="number1">
            Введите первое число:
            <input type="number" name="number1">
        </label>
        <label for="number2">
            Введите второе число:
            <input type="number" name="number2">
        </label>
        <input type="submit">
    </form>
    <?php
        $number1="";
        $number2="";
        if (isset($_GET["number1"])) $number1=$_GET["number1"];
        if (isset($_GET["number2"])) $number2=$_GET["number2"];
        echo "Первое число - $number1";
        echo "<br>Второе число - $number2";
        if (is_numeric($number1) and is_numeric($number2)) echo "<br>Сумма чисел - ". $number1 + $number2;
    ?>
</body>
</html>