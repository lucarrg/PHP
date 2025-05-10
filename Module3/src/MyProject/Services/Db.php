<?php

namespace MyProject\Services;

use MyProject\Exceptions\DbException;

class Db                                                                                                 //Класс для работы с БД

{
    /** @var \PDO */
    private $pdo;
    private static $instance;

    private function __construct()
    {
        $settingsPath = realpath(__DIR__ . '/../../settings.php');
        $dbOptions = (require $settingsPath)['db'];

        try{
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');                                                            //Свойство $this->pdo теперь можно использовать для работы с базой данных через PDO
        } catch (\PDOException $e) {

            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());

        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array      //Метод для выполнения запросов в БД
    {                                                                                                   //Третьим аргументом в этот метод будет передаваться имя класса, объекты которого нужно создавать. По умолчанию это будут объекты класса stdClass – это такой встроенный класс в PHP, у которого нет никаких свойств и методов.
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);                                           //В метод fetchAll() мы передали специальную константу - \PDO::FETCH_CLASS, она говорит о том, что нужно вернуть результат в виде объектов какого-то класса. Второй аргумент – это имя класса, которое мы можем передать в метод query().
    }
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}