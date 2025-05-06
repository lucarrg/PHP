<?php

namespace MyProject\View;

class View
{
    private $templatesPath;                                                 //путь до шаблона, который надо запустить
 
    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    public function renderHtml(string $templateName, array $vars = [])      //передаётся путь и массив с данными, который будет использован в шаблоне
    {
        extract($vars);                                                     //Функция extract извлекает массив в переменные. То есть она делает следующее: в неё передаётся массив ['key1' => 1, 'key2' => 2], а после её вызова у нас имеются переменные $key1 = 1 и $key2 = 2.
        include $this->templatesPath . '/' . $templateName;
    }
}