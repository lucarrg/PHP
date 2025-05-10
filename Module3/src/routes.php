<?php
                                                                                           // это просто массив, у которого ключи – это регулярка для адреса, а значение – это массив с двумя значениями – именем контроллера и названием метода
return [                                                                                   //~ - ограничители регулярки, ^-начало строки, $-конец строки, .-любой символ, (.*)-0 или больше любого символа. Содержимое в скобках называется карманом. Оно будет захвачено и после передано в качестве элемента в массиве matches.
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'show'],    //Вызывается объект (н-р, типа MainController) и в зависимоти от роута вызывается определённый метод
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\CommentsController::class, 'add'],
    '~^articles/\d+/comments/(\d+)/edit$~' => [\MyProject\Controllers\CommentsController::class, 'edit'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^about-me$~' => [\MyProject\Controllers\MainController::class, 'about'],
];