<?php
namespace app\controllers;

use app\model\Products;

// отдаёт json для фронтенда
class ApiController extends Controller {

	public function actionCatalog() {
		// выводит по 2 товара на странице каталог
		$page = $_GET['page'] ?? 0;
		$page++;
		$limit = $page * 2;
        $products = Products::getLimit(0, $limit);
        header('Content-Type: application/json');
		echo json_encode(['product' => $products], JSON_UNESCAPED_UNICODE);
    }
}