<?php
namespace app\model\entities;

class Users extends DataEntity
{
    //поля совпадают с БД
	public $id;
	public $login;
    public $pass;

 
}