<?php
namespace app\model\repositories;

use app\model\Repository;
use app\model\entities\Basket;

class BasketRepository extends Repository	
{
    public function getBasket($session) {
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price FROM basket b,products p WHERE b.product_id=p.id AND session_id = :session";
        return $this->db->queryAll($sql, ['session' => $session]);
    }

    public function getEntityClass() {
        return Basket::class;
    }

    public function getTableName() {
        return 'basket';
    }


}