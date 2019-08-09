<?php
namespace app\model;
use app\interfaces\IModel;
use app\engine\Db;

abstract class DbModel extends Models
{   

    public static function getTableName() {
        return '';
    }
    

// возвращает объект
    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll() {
        $tableName = static::getTableName();
        $sql ="SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
 
    // выводит $limit товаров
    public function getLimit(int $from, int $limit) {
        $tableName = static::getTableName();
        $sql ="SELECT * FROM {$tableName} LIMIT {$from}, {$limit}";
        return Db::getInstance()->queryAll($sql);
    }

    // возвращает колличество в поле $field = $value Например кол-во товаров в корзине
    public static function getCountWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(*) as count FROM `$tableName` WHERE `$field` = :$field";
        return Db::getInstance()->queryOne($sql, ["$field" => $value])['count'];
    }

    // выбрать одну запись где поле $field = $value
    public static function getOneWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `$tableName` WHERE `$field` = :$field";
        return Db::getInstance()->queryObject($sql, ["$field" => $value], static::class);
    }

    public function insert(){
        $params = [];
        $columns = [];
        foreach($this as $key => $value) {
            if($key == 'id')  continue;
            $params[":{$key}"] = $value;
            $columns[] = "`$key`";
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        
        Db::getInstance()->execute($sql, $params);

        // возвращает последний вставленый id
        $this->id = Db::getInstance()->lastInsertId();
       
    }

    public function update() {
        // $tableName = static::getTableName();
        // $sql = "SELECT * FROM {$tableName} WHERE id = :id";
       // "UPDATE {$tableName} SET last_name = 'Ford' WHERE customer_id = 500";

    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $db = Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save() {
        if(is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }
} 