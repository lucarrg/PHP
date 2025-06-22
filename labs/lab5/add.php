<form name="form_add" method="post">
    <div class="column">
    <div class="add">
        <label>Фамилия</label> <input type="text" name="surname" placeholder="Фамилия">
    </div>
    <div class="add">
        <label>Имя</label> <input type="text" name="name" placeholder="Имя">
    </div>
    <div class="add">
        <label>Отчество</label> <input type="text" name="patronymic" placeholder="Отчество">
    </div>
    <div class="add">
        <label>Пол</label> 
        <select name="gender">
            <option value="мужской">Мужской</option>
            <option value="женский">Женский</option>
        </select>
    </div>
    <div class="add">
        <label>Дата рождения</label> <input type="date" name="date">
    </div>
    <div class="add">
        <label>Телефон</label> <input type="text" name="phone" placeholder="Телефон">
    </div>
    <div class="add">
        <label>Адрес</label> <input type="text" name="address" placeholder="Адрес"> 
    </div>
    <div class="add">
        <label>Email</label> <input type="email" name="email" placeholder="Email">
    </div>
    <div class="add">
        <label>Комментарий</label> <textarea name="comment" placeholder="Краткий комментарий"></textarea>
    </div>

        <button type="submit" name="button" class="form-btn">Добавить запись</button>
    </div>
</form>

<?php
// если были переданы данные для добавления в БД
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $mysqli = mysqli_connect('localhost', 'root', '', 'notebook');
    
    if( mysqli_connect_errno() ) // проверяем корректность подключения
    echo 'Ошибка подключения к БД: '.mysqli_connect_error();
    // формируем и выполняем SQL-запрос для добавления записи
    $sql_res=mysqli_query($mysqli, 'INSERT INTO users VALUES ("'.
    htmlspecialchars($_POST['surname']).'", "'.
    htmlspecialchars($_POST['name']).'", "'.
    htmlspecialchars($_POST['patronymic']).'", "'.
    htmlspecialchars($_POST['phone']).'", "'.
    htmlspecialchars($_POST['address']).'", "'.
    htmlspecialchars($_POST['date']).'", "'.
    htmlspecialchars($_POST['gender']).'", "'.
    htmlspecialchars($_POST['email']).'", "'.
    htmlspecialchars($_POST['comment']).'")');
    // если при выполнении запроса произошла ошибка – выводим сообщение
    if( mysqli_errno($mysqli) )
    echo '<div class="error">Запись не добавлена</div>'; else // если все прошло нормально – выводим сообщение
    echo '<div class="ok">Запись добавлена</div>';
}
?>