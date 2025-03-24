<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['expression'])) {
        $expression = $_POST['expression'];
        if (preg_match('/^[0-9+\-*/()]+$/', $expression)) {
            try {
                $result = evaluateExpression($expression);
                echo $result;
            } catch (Exception $e) {
                echo 'Ошибка: ' . $e->getMessage();
            }
        } else {
            echo 'Ошибка: Неверное выражение';
        }
    }
}

function evaluateExpression($expression) {
    return eval("return $expression;");
}
?>