<?php
namespace app\model\repositories;

use app\model\Repository;
use app\model\entities\Orders;

class OrdersRepository extends Repository
{
    public function getTableName() {
        return 'orders';
    }

    public function getEntityClass() {
        return Orders::class;
    }
}