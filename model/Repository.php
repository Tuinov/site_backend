<?php
namespace app\model;

use app\engine\Db;

abstract class Repository
{
    protected $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }


// возвращает объект
    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql ="SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }
 
    // выводит $limit товаров
    public function getLimit(int $from, int $limit) {
        $tableName = $this->getTableName();
        $sql ="SELECT * FROM {$tableName} LIMIT {$from}, {$limit}";
        return $this->db->queryAll($sql);
    }

    // возвращает колличество в поле $field = $value Например кол-во товаров в корзине
    public function getCountWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as count FROM `$tableName` WHERE `$field` = :$field";
        return $this->db->queryOne($sql, ["$field" => $value])['count'];
    }

    // выбрать одну запись где поле $field = $value
    public function getOneWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `$tableName` WHERE `$field` = :$field";
        return $this->db->queryObject($sql, ["$field" => $value], $this->getEntityClass());
    }

    public function insert($entity){
        $params = [];
        $columns = [];
        foreach($entity as $key => $value) {
            if($key == 'id')  continue;
            $params[":{$key}"] = $value;
            $columns[] = "`$key`";
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        
        $this->db->execute($sql, $params);

        // возвращает последний вставленый id
        $entity->id = $this->db->lastInsertId();
       
    }

    public function update($entity) {
        // $tableName = $this->getTableName();
        // $sql = "SELECT * FROM {$tableName} WHERE id = :id";
       // "UPDATE {$tableName} SET last_name = 'Ford' WHERE customer_id = 500";

    }

    public function delete($entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $db = $this->db->execute($sql, ['id' => $entity->id]);
    }

    public function save($entity) {
        if(is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }
}    