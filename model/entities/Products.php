<?php
namespace app\model\entities;

class Products extends DataEntity
{
    //поля совпадают с БД
	public $id;
	public $name;
	public $description;
    public $price;

    // public $properties = [
    //     'id' => false,
    //     'name' => '',
    //     'description' => '',
    //     'price' => ''
    // ]

    public function __construct($name = null, $description = null, $price = null) {
        
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }


}