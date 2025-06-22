<?php
session_start();
if (!isset($_SESSION['counter'])) {
    echo "Вы ещё не обновляли страницу";

    $_SESSION['counter'] = 1;
} else {
    echo 'Вы обновили страницу ' . $_SESSION['counter'] . ' раз';
    $_SESSION['counter'] = $_SESSION['counter'] + 1;
}