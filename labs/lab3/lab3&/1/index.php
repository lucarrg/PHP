<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 1</title>
    <style>
        .textarea {
            display: block;
            height: 100px;
            width: 400px;
        }
    </style>
</head>
<body>
    <h1>Задание 1</h1>
    <p>Жесткая ссылка. Каждое второе слово в тексте, введенным пользователем на странице, преобразовать в слово из заглавных букв.<br>
        Использовать GET или POST параметры запроса. Преобразование слов выполнить в функции, передав в нее ссылку на массив введенных слов</p>
    <form method="POST">
        <label for="text">
            Введите текст:
            <textarea name="text" id="text" class="textarea"></textarea>
        </label>
        <button type="submit">Преобразовать</button>
    </form>
    <br>
    <?php
        $words="";
        if (isset($_POST["text"])) {
            $words = explode(" ", $_POST["text"]);
            secondWordCapitalized($words);
            foreach ($words as $word) echo "$word ";
        }

        function secondWordCapitalized(&$arr) {
            for ($i=0; $i<count($arr);$i++) {
                if ($i % 2 != 0){
                    $arr[$i] = mb_strtoupper($arr[$i]);
                }
            }
        }
    ?>
</body>
</html>