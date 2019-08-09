<?php
namespace app\engine;

class Db 
{
    private $connection = null;
    private static $instance = null;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {} 

    public static function getInstance() {
        if(is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    // подключение к бд
    public function getConnection() {
        if(is_null($this->connection)) {
            $this->connection = new \PDO('mysql:host=localhost;port=3307;dbname=geekbrains', 'root', '');
            
            // режим получения данных по умолчанию - режим ассоциативного массива
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }
    
    private function query($sql, $params) {
        $stml = $this->getConnection()->prepare($sql);  // подключение к бд и подготовка запроса $sql
        $stml->execute($params);                        
        return $stml;
    }

    // запрос возвращающий обЪект класса $class
    public function queryObject($sql, $params, $class) {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $stmt->fetch();
    }

    
    public function execute($sql, $params = []) {
        $this->query($sql, $params);
        return true;

    }

    // возвращает последний id
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

    // запрос в БД возвращающий 1 значение в виде массива
    public function queryOne($sql, $param = []) {
        return $this->queryAll($sql, $param)[0];
    }

    public function queryAll($sql, $param = []) {
        return $this->query($sql, $param)->fetchAll();
    }


}