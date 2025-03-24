<?php
    //1
    echo "Задание 1<br>";
    $letters = ['a', 'b', 'c', 'b', 'a'];
    echo array_count_values($letters)['a'];
    echo "<br><br>";

    //5
    echo "Задание 5<br>";
    $arr = ['a'=>1, 'b'=>2, 'c'=>3];
    $keys = array_keys($arr);
    $values = array_values($arr);
    echo "keys:";
    foreach ($keys as $key) echo " $key";
    echo "<br> values:";
    foreach ($values as $value) echo " $value";
    echo "<br><br>";

    //10
    echo "Задание 10<br>";
    //Массив в этом задании повторяет массив из задания 5, поэтому мы будем пользоваться переменной arr
    $rand_key = array_rand($arr);
    echo "Случайный ключ - $rand_key, случайный элемент - $arr[$rand_key]<br><br>";

    //15
    echo "Задание 15<br>";
    $arr = [1, 2, 3, 4, 5];
    array_unshift($arr, 0);
    array_push($arr, 6);
    foreach ($arr as $elem) echo "$elem ";
    echo "<br><br>";

    //20
    echo "Задание 20<br>";
    $arr = [1, 2, 3, 4, 5];
    array_splice($arr, 1, 2);
    foreach ($arr as $elem) echo "$elem ";
?>
