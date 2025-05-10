<?php

namespace MyProject\View;

class View
{
    private $templatesPath;                                                                    //путь до шаблона, который надо запустить
 
    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    public function renderHtml(string $templateName, array $vars = [], int $code = 200)      //передаётся путь и массив с данными, который будет использован в шаблоне
    {
        http_response_code($code);                                                           //По умолчанию, если мы не передадим третьим аргументом код, будет возвращён 200-ый, иначе – заданный нами.
        extract($vars);                                                                      //Функция extract извлекает массив в переменные. То есть она делает следующее: в неё передаётся массив ['key1' => 1, 'key2' => 2], а после её вызова у нас имеются переменные $key1 = 1 и $key2 = 2.
        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();
        echo $buffer;
    }
}