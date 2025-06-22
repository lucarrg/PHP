<form name="form_add" method="post">
    <div class="column">
    <div class="add">
        <label>Фамилия</label> <input type="text" name="surname" placeholder="Фамилия" required>
    </div>
    <div class="add">
        <label>Имя</label> <input type="text" name="name" placeholder="Имя" required>
    </div>
    <div class="add">
        <label>Отчество</label> <input type="text" name="patronymic" placeholder="Отчество">
    </div>
    <div class="add">
        <label>Пол</label> 
        <select name="gender" required>
            <option value="">-</option>
            <option value="Мужчина">Мужчина</option>
            <option value="Женщина">Женщина</option>
        </select>
    </div>
    <div class="add">
        <label>Дата рождения</label> <input type="date" name="date" required>
    </div>
    <div class="add">
        <label>Телефон</label> <input type="text" name="phone" placeholder="Телефон" required>
    </div>
    <div class="add">
        <label>Адрес</label> <input type="text" name="address" placeholder="Адрес" required> 
    </div>
    <div class="add">
        <label>Email</label> <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="add">
        <label>Комментарий</label> <textarea name="comment" placeholder="Краткий комментарий"></textarea>
    </div>

        <button type="submit" name="button" class="form-btn">Добавить запись</button>
    </div>
</form>

<?php
// Включение отображения ошибок
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mysqli = mysqli_connect('localhost', 'root', '', 'notebook');
    mysqli_set_charset($mysqli, 'utf8');
    
    if(!$mysqli) {
        die('<div class="error">Ошибка подключения к БД: '.mysqli_connect_error().'</div>');
    }

    // Проверка структуры таблицы
    $result = mysqli_query($mysqli, "DESCRIBE users");
    $columns = [];
    while($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
    }

    // Подготовка данных
    $data = [
        'surname' => $_POST['surname'] ?? '',
        'name' => $_POST['name'] ?? '',
        'patronymic' => $_POST['patronymic'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'date' => $_POST['date'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'email' => $_POST['email'] ?? '',
        'comment' => $_POST['comment'] ?? ''
    ];

    // Фильтрация данных по существующим столбцам
    $filtered_data = array_intersect_key($data, array_flip($columns));
    
    // Формирование SQL запроса
    $columns_str = implode(', ', array_keys($filtered_data));
    $values_str = "'" . implode("', '", array_map(function($v) use ($mysqli) {
        return mysqli_real_escape_string($mysqli, $v);
    }, array_values($filtered_data))) . "'";

    $sql = "INSERT INTO users ($columns_str) VALUES ($values_str)";
    
    if(mysqli_query($mysqli, $sql)) {
        mysqli_close($mysqli);
        // Редирект на ту же страницу с параметром успеха
        header("Location: ".$base_url."/PHP/labs/lab5/index.php?p=add&success=1");
        exit;
    } else {
        echo '<div class="error">Ошибка: '.mysqli_error($mysqli).'</div>';
        mysqli_close($mysqli);
    }
}

// Показываем сообщение об успехе после редиректа
if(isset($_GET['success'])) {
    echo '<div class="ok">Запись успешно добавлена</div>';

}
?>