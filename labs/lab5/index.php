<?php
    //Подключаем модуль меню
    require_once 'menu.php';

    //Если параметр 'p' есть в URL, то он будет равен ему. Если его нет, то он по умолчанию будет view
    $p = $_GET['p'] ?? 'viewer';

    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Записная книжка</title>';
    echo '<link rel="stylesheet" href="style.css"></head><body>';

    //Выводим меню
    $sort = $_GET['sort'] ?? 'id';
    echo get_menu($p, $sort);

    //Подключаем соответствующий модуль
    switch ($p) {
        case 'add':
            include 'add.php';
            break;
        case 'edit':
            include 'edit.php';
            break;
        case 'delete':
            include 'delete.php';
            break;
        default:
            include 'viewer.php';
            // если в параметрах не указана текущая страница – выводим самую первую
            if( !isset($_GET['pg']) || $_GET['pg']<0 ) $_GET['pg']=0;

            // если в параметрах не указан тип сортировки или он недопустим
            if(!isset($_GET['sort']) || ($_GET['sort']!='id' && $_GET['sort']!='surname' &&
            $_GET['sort']!='date'))
            $_GET['sort']='id'; // устанавливаем сортировку по умолчанию

            // формируем контент страницы с помощью функции и выводим его
            echo getFriendsList($_GET['sort'], $_GET['pg']);
    }

    echo '</body></html>';
?>