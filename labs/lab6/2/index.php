<?php
session_start();
$_SESSION['second'] = 'hi second!';
echo '<a href="second.php">Вторая страница</a>';