<?php
session_start();
if (!isset($_SESSION['test'])) {
    $_SESSION['test'] = 'test';
} else {
    echo $_SESSION['test'];
}