<?php
namespace app\model\entities;
use app\model\entities\DataEntity;

class Orders extends DataEntity	
{
    //поля совпадают с БД
    public $id;
    public $session_id;
    public $name;
    public $email;
    public $tel;
    public $status;
    
    
    public function __construct($session_id = null)
    {
        $this->session_id = $session_id;
        
    }
   
   
}