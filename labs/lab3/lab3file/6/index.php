<?php
    $num = file_get_contents('test.txt');
    if (is_numeric($num)) {
        $num = intval($num)**2;
        file_put_contents('test.txt', $num);
    }
?>