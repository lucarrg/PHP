<?php

try {
    spl_autoload_register(function (string $className) {                //регистрирует пользовательскую функцию автозагрузки. Эта функция будет вызываться каждый раз, когда PHP не может найти класс (или интерфейс) и пытается его загрузить.

        require_once __DIR__ . '/../src/' . $className . '.php';        //подключает файл, если он еще не был подключен. __DIR__ — это магическая константа, которая возвращает путь к текущей директории, где находится скрипт
    
    });
    
    $route = $_GET['route'] ?? '';                                      
    $routes = require __DIR__ . '/../src/routes.php';                   //переход к системе роутинга
    
    $isRouteFound = false;
    
    foreach ($routes as $pattern => $controllerAndAction) {             //для каждого регулярного выражения и пары контроллер/метод выполним цикл
    
        preg_match($pattern, $route, $matches);                         //находит соответсвия по типу pattern в выражении route и записывает их в matches
    
        if (!empty($matches)) {
            $isRouteFound = true;                                       //если совпадения есть, значит true. так как в этом моменте останавливается цикл, то cpntrollerAndAction тоже приимает то значение, на котором он остановился в цикле
            break;
        }
    
    }
    
    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException();
    }
    
    unset($matches[0]);                                                 //удаляются элементы с индексом 0, потому что в нём записано выражение целиком, а дальше уже подходящий параметр
    
    $controllerName = $controllerAndAction[0];                          //присваиваем имя контроллера
    $actionName = $controllerAndAction[1];                              //присваиваем имя метода
    
    $controller = new $controllerName();                                //создаём объект класса контроллера
    $controller->$actionName(...$matches);                              //вызываем у объекта необходимый метод
} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}
