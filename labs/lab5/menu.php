<?php

function get_menu($active_page = 'viewer', $active_sort = 'id') {
    $menu = [
        'viewer' => 'Просмотр',
        'add' => 'Добавление записи',
        'delete' => 'Удаление записи',
        'edit' => 'Редактирование записи'
    ];

    $html = '<header>';
    foreach ($menu as $key => $value) {
        $class = ($key === $active_page) ? 'select' : '';
        $html .= "<a href='?p=$key' class='$class'>$value</a>";
    }
    $html .= '</header>';

    //Дополнительно меню для выбора сортировки в разделе Просмотр
    if ($active_page === 'viewer') {
        $sorts = [
            'id' => 'По добавлению',
            'surname' => 'По фамилии',
            'date' => 'По дате рождения'
        ];
        $html .= "<div class='submenu'>";
        foreach ($sorts as $key => $value) {
            $class = ($key === $active_sort) ? 'select' : '';
            $html .= "<a href='?p=viewer&sort=$key' class='$class'>$value</a>";
        }
        $html .= '</div>';
    }
    return $html;
}
?>