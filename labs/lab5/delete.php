<?php
// Подключение к базе данных
$mysqli = mysqli_connect('localhost', 'root', '', 'notebook');
if(mysqli_connect_errno()) {
    echo '<div class="error">Ошибка подключения к БД: '.mysqli_connect_error().'</div>'; 
    exit();
}

// Обработка удаления записи
if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Сначала получаем фамилию для сообщения
    $sql = "SELECT surname FROM users WHERE id=$id LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    $surname = $row['surname'] ?? '';
    
    // Удаляем запись
    $sql = "DELETE FROM users WHERE id=$id";
    if(mysqli_query($mysqli, $sql)) {
        echo '<div class="ok">Запись с фамилией '.htmlspecialchars($surname).' удалена</div>';
    } else {
        echo '<div class="error">Ошибка удаления: '.mysqli_error($mysqli).'</div>';
    }
}

// Получение списка записей для отображения
$sql = "SELECT id, surname, name FROM users ORDER BY surname, name";
$result = mysqli_query($mysqli, $sql);

if(!$result) {
    echo '<div class="error">Ошибка получения списка: '.mysqli_error($mysqli).'</div>';
} elseif(mysqli_num_rows($result) == 0) {
    echo '<div class="notice">Нет записей для удаления</div>';
} else {
    echo '<div class="records-list">';
    while($row = mysqli_fetch_assoc($result)) {
        // Формируем фамилию и инициалы (первая буква имени)
        $initials = mb_substr($row['name'], 0, 1).'.';
        $displayName = htmlspecialchars($row['surname']).' '.htmlspecialchars($initials);
        
        echo '<div class="record-item">';
        echo '<a href="?p=delete&id='.$row['id'].'" class="delete-link">'.$displayName.'</a>';
        echo '</div>';
    }
    echo '</div>';
}

mysqli_close($mysqli);
?>