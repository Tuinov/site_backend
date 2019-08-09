<?php
namespace app\model\entities;
use app\model\entities\DataEntity;

class Basket extends DataEntity	
{
    //поля совпадают с БД
    public $id;
    public $product_id;
	public $session_id;
    
    
    public function __construct($session_id = null, $product_id = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
    }
   
   
}