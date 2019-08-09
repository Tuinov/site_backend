<?php
namespace app\controllers;
use app\model\repositories\OrdersRepository;

class OrdersController extends Controller {
    public function actionsend() {
		// выводит по 2 товара на странице каталог
		
		echo $this->render('orders', []);
	}

}