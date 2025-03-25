<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 21</title>
</head>
<body>
    <h1>Задание 21</h1>
    <p>Символическая ссылка. Вводится римскими цифрами век. Нужно напечатать, кто царствовал в этом веке.<br>
        Например, ввели "XVI", нужно вывести "В XVI веке царствовал Иван Васильевич". Дано: $XVI="Иван Васильевич"; $XVIII="Пётр Алексеевич"; $XIX="Николай Павлович";</p>
    <form method="GET">
        <label for="century">
            Выберите век царствования:
            <select name="century" id="century">
                <option>XVI</option>
                <option>XVIII</option>
                <option>XIX</option>
            </select>
        </label>
        <button type="submit">Отправить</button>
    </form>
    <br>
    <?php
        $XVI="Иван Васильевич";
        $XVIII="Пётр Алексеевич";
        $XIX="Николай Павлович";
        $century="";
        if (isset($_GET["century"])) {
            $century = $_GET["century"];
            echo "В $century веке царствовал " . $$century;
        }
    ?>
</body>
</html>