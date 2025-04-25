<?php
    //Подключаем модуль меню
    require_once 'menu.php';

    //Если параметр 'p' есть в URL, то он будет равен ему. Если его нет, то он по умолчанию будет view
    $p = $_GET['p'] ?? 'view';

    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Записная книжка</title>';
    echo '<link rel="stylesheet" href="style.css"></head><body>';

    //Выводим меню

    echo get_menu($p);

    //Подключаем соответствующий модуль
    switch ($p) {
        case 'add':
            require_once 'add.php';
            show_add_form();
            break;
        case 'edit':
            require_once 'edit.php';
            show_edit_form();
            break;
        case 'delete':
            require_once 'delete.php';
            show_delete_list();
            break;
        default:
            require_once 'viewer.php';
            $sort = $_GET['sort'] ?? 'id';
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            show_viewer($sort, $page);
    }

    echo '</body></html>';
?>