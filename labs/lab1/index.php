<?php
    //1
    echo 'Задание 1<br>';
    $a=27;
    $b=12;
    $c = ($a ** 2 + $b ** 2) ** 0.5;
    $c = round($c, 2);
    echo "a = $a b = $b гипотенуза: $c <br><br>";
    

    //14
    echo 'Задание 14<br>';
    $quiter = 'Тише';
    $go = 'едешь';
    $further = 'дальше';
    echo $quiter . " " . $go . " - " . $further . " будешь.<br><br>";


    //23
    echo 'Задание 23<br>';
    $a=7;
    $b=4;
    $c=' воробья';
    $v=$a-$b;
    echo $v . $c . "<br><br>";


    //39
    echo 'Задание 37<br>';
    $a=7;
    $b=8;
    $z = $a ** $b > $b ** $a ? "$a ** $b =" . $a ** $b : "a = $a b = $b";
    echo "$z<br><br>"; 

    
    //44
    echo 'Задание 44<br>';
    $year=2022;
    $month=3;
    $day=2;
    echo sprintf("Дата: %d-%02d-%02d", $year, $month, $day);
?>