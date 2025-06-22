<?php
function getFriendsList($type, $page)
{
    // осуществляем подключение к базе данных
    $mysqli = mysqli_connect('localhost', 'root', '', 'notebook');

    if( mysqli_connect_errno() ) // проверяем корректность подключения
    return 'Ошибка подключения к БД: '.mysqli_connect_error();

    // формируем и выполняем SQL-запрос для определения числа записей
    $sql_res=mysqli_query($mysqli, 'SELECT COUNT(*) FROM users');

    if(!$sql_res) { // если запрос не выполнился
        return 'Ошибка запроса: '.mysqli_error($mysqli);
    }

    $row = mysqli_fetch_row($sql_res);
    $TOTAL = (int)$row[0];
    if ($TOTAL == 0)      // если в таблице нет записей
        return 'В таблице нет данных'; // возвращаем сообщение


    $PAGES = ceil($TOTAL/10); // вычисляем общее количество страниц
    if ($page < 0) $page = 0; // чтобы не было отрицательных страниц
    $total_pages = ceil($TOTAL / 10);
    if ($page >= $total_pages) {
        $page = $total_pages - 1;
    }


    // формируем и выполняем SQL-запрос для выборки записей из БД
    $sql = 'SELECT * FROM users ORDER BY '.mysqli_real_escape_string($mysqli, $type).' LIMIT '.($page * 10).', 10';
    $sql_res = mysqli_query($mysqli, $sql);
    if(!$sql_res) { // если запрос не выполнился
        return 'Ошибка запроса: '.mysqli_error($mysqli);
    }


    $ret='<table>';       // строка с будущим контентом страницы
    $ret.='<tr><td>Фамилия</td>
        <td>Имя</td>
        <td>Отчество</td>
        <td>Пол</td>
        <td>Дата рождения</td>
        <td>E-mail</td>
        <td>Телефон</td>
        <td>Адрес</td>
        <td>Комментарий</td></tr>';
    while( $row=mysqli_fetch_assoc($sql_res) ) // пока есть записи
    {
    // выводим каждую запись как строку таблицы
        $ret.='<tr><td>'.$row['surname'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['patronymic'].'</td>
        <td>'.$row['gender'].'</td>
        <td>'.$row['date'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['phone'].'</td>
        <td>'.$row['address'].'</td>
        <td>'.$row['comment'].'</td></tr>';
    }
    $ret.='</table>'; // заканчиваем формирование таблицы с контентом

    if ($PAGES > 1) {
        $ret .= '<div id="pages" class="pages">';
        for ($i = 0; $i < $PAGES; $i++) {
            if ($i != $page) {
                $ret .= '<a href="?p=viewer&sort=' . $type . '&pg=' . $i . '">' . ($i + 1) . '</a>';
            } else {
                $ret .= '<span class="select_page">' . ($i + 1) . '</span>';
            }
        }
        $ret .= '</div>';
    }

    mysqli_close($mysqli);

    return $ret;          // возвращаем сформированный контент
}