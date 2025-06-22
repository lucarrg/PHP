<?php
// Подключение к базе данных
$mysqli = mysqli_connect('localhost', 'root', '', 'notebook');
if(mysqli_connect_errno()) {
    echo '<div class="error">Ошибка подключения к БД: '.mysqli_connect_error().'</div>'; 
    exit();
}

// 1. ОБРАБОТКА ИЗМЕНЕНИЯ ЗАПИСИ
if(isset($_POST['button']) && $_POST['button'] == 'Изменить запись') {
    // Проверяем наличие ID
    if(!isset($_GET['id'])) {
        echo '<div class="error">Не указан ID записи для редактирования</div>';
    } else {
        // Подготовка данных
        $id = (int)$_GET['id'];
        $fields = [
            'surname' => mysqli_real_escape_string($mysqli, $_POST['surname'] ?? ''),
            'name' => mysqli_real_escape_string($mysqli, $_POST['name'] ?? ''),
            'patronymic' => mysqli_real_escape_string($mysqli, $_POST['lastname'] ?? ''),
            'gender' => mysqli_real_escape_string($mysqli, $_POST['gender'] ?? ''),
            'date' => mysqli_real_escape_string($mysqli, $_POST['date'] ?? ''),
            'phone' => mysqli_real_escape_string($mysqli, $_POST['phone'] ?? ''),
            'address' => mysqli_real_escape_string($mysqli, $_POST['location'] ?? ''),
            'email' => mysqli_real_escape_string($mysqli, $_POST['email'] ?? ''),
            'comment' => mysqli_real_escape_string($mysqli, $_POST['comment'] ?? '')
        ];
        
        // SQL-запрос на обновление
        $sql = "UPDATE users SET 
                surname='{$fields['surname']}',
                name='{$fields['name']}',
                patronymic='{$fields['patronymic']}',
                gender='{$fields['gender']}',
                date='{$fields['date']}',
                phone='{$fields['phone']}',
                address='{$fields['address']}',
                email='{$fields['email']}',
                comment='{$fields['comment']}'
                WHERE id=$id";
        
        if(mysqli_query($mysqli, $sql)) {
            echo '<div class="ok">Данные успешно изменены</div>';
            // Обновляем данные текущей записи
            $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";
            $result = mysqli_query($mysqli, $sql);
            $currentROW = mysqli_fetch_assoc($result);
        } else {
            echo '<div class="error">Ошибка изменения: '.mysqli_error($mysqli).'</div>';
        }
    }
}

// 2. ПОЛУЧЕНИЕ ТЕКУЩЕЙ ЗАПИСИ
$currentROW = [];
if(isset($_GET['id'])) {
    $sql = "SELECT * FROM users WHERE id=".(int)$_GET['id']." LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    if($result) {
        $currentROW = mysqli_fetch_assoc($result);
    }
}

// Если запись не найдена - берем первую
if(!$currentROW) {
    $sql = "SELECT * FROM users LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    if($result) {
        $currentROW = mysqli_fetch_assoc($result);
    }
}

// 3. ВЫВОД СПИСКА ЗАПИСЕЙ
$sql_res = mysqli_query($mysqli, "SELECT id, name, surname FROM users ORDER BY surname, name");
if(!mysqli_errno($mysqli)) {
    echo '<div class="records-list">';
    while($row = mysqli_fetch_assoc($sql_res)) {
        if($currentROW && $currentROW['id'] == $row['id']) {
            echo '<div class="current-record">'.$row['surname'].' '.$row['name'].'</div>';
        } else {
            echo '<a href="?p=edit&id='.$row['id'].'" class="record-link">'.
                 $row['surname'].' '.$row['name'].'</a>';
        }
    }
    echo '</div>';
} else {
    echo '<div class="error">Ошибка получения списка: '.mysqli_error($mysqli).'</div>';
}

// 4. ФОРМА РЕДАКТИРОВАНИЯ
if($currentROW) {
    ?>
    <form name="form_edit" method="post" action="?p=edit&id=<?= $currentROW['id'] ?>" class="column">
        <input type="hidden" name="id" value="<?= $currentROW['id'] ?>">
        
        <div class="add">
            <label>Фамилия</label> 
            <input type="text" name="surname" placeholder="Фамилия" 
                   value="<?= htmlspecialchars($currentROW['surname'] ?? '') ?>" required>
        </div>
        
        <div class="add">
            <label>Имя</label> 
            <input type="text" name="name" placeholder="Имя" 
                   value="<?= htmlspecialchars($currentROW['name'] ?? '') ?>" required>
        </div>
        
        <div class="add">
            <label>Отчество</label> 
            <input type="text" name="lastname" placeholder="Отчество" 
                   value="<?= htmlspecialchars($currentROW['patronymic'] ?? '') ?>">
        </div>
        
        <div class="add">
            <label>Пол</label> 
            <select name="gender" required>
                <option value="">- Выберите пол -</option>
                <option value="Мужчина" <?= ($currentROW['gender'] ?? '') == 'Мужчина' ? 'selected' : '' ?>>Мужчина</option>
                <option value="Женщина" <?= ($currentROW['gender'] ?? '') == 'Женщина' ? 'selected' : '' ?>>Женщина</option>
            </select>
        </div>
        
        <div class="add">
            <label>Дата рождения</label> 
            <input type="date" name="date" 
                   value="<?= htmlspecialchars($currentROW['date'] ?? '') ?>" required>
        </div>
        
        <div class="add">
            <label>Телефон</label> 
            <input type="text" name="phone" placeholder="Телефон" 
                   value="<?= htmlspecialchars($currentROW['phone'] ?? '') ?>" required>
        </div>
        
        <div class="add">
            <label>Адрес</label> 
            <input type="text" name="location" placeholder="Адрес" 
                   value="<?= htmlspecialchars($currentROW['address'] ?? '') ?>" required>
        </div>
        
        <div class="add">
            <label>Email</label> 
            <input type="email" name="email" placeholder="Email" 
                   value="<?= htmlspecialchars($currentROW['email'] ?? '') ?>" required>
        </div>
        
        <div class="add">
            <label>Комментарий</label> 
            <textarea name="comment" placeholder="Краткий комментарий"><?= htmlspecialchars($currentROW['comment'] ?? '') ?></textarea>
        </div>
        
        <button type="submit" name="button" value="Изменить запись" class="form-btn">
            Изменить запись
        </button>
    </form>
    <?php
} else {
    echo '<div class="notice">Нет записей для редактирования</div>';
}

mysqli_close($mysqli);
?>