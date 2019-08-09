<?php
namespace app\controllers;

use app\engine\Request;
use app\model\entities\Basket;
use app\model\repositories\BasketRepository;

class BasketController extends Controller
{
    // асинхронное добавление товара в корзину
    public function actionAddBasket() {
        $id = $_POST['id'];
        $basket = new Basket(session_id(), $id);
        (new BasketRepository())->insert($basket);
        // (new Basket(session_id(),$id))->insert();
        $count =  (new BasketRepository())->getCountWhere('session_id', session_id());
        
        $response = [
            'result' => 1,
            'count' => $count
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    // асинхронное удаление товара из корзины
    public function actionDelBasket() {
        $id = $_POST['id'];
        $basket = (new BasketRepository())->getOne($id);
        
        (new BasketRepository())->delete($basket);
       
        $count = (new BasketRepository())->getCountWhere('session_id', session_id());
        $response = [
            'result' => 1,
            'count' => $count
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionIndex()
    {
        echo $this->render('basket', [
            'products' => (new BasketRepository())->getBasket(session_id())]);
    }
}