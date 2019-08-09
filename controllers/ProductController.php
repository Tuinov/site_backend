<?php
namespace app\controllers;
use app\model\repositories\ProductRepository;

class ProductController extends Controller {

	public function actionCatalog() {
		// выводит по 2 товара на странице каталог
		$page = $_GET['page'] ?? 0;
		$page++;
		$limit = $page * 2;
		$products = (new ProductRepository())->getLimit(0, $limit);
		echo $this->render('catalog', ['products' => $products, 'page' => $page]);
	}

	function actionCard() {
		$id = $_GET['id'];
		$product = (new ProductRepository())->getOne($id);
		echo $this->render('card', ['product' => $product]);
		
		//echo $this->render('card', ['name' => 'шапка', 'description' => 'шерстяная', 'price' => 100]);
		
	}

	

}