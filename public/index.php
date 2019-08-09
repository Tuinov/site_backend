<?php
session_start();

include '../engine/AutoLoad.php';
include '../config/config.php';
require_once '../vendor/autoload.php';

use app\model\Products;
use app\model\Users;
use app\engine\AutoLoad;
use app\engine\Db;
use app\engine\Render;
use app\engine\Request;
// use app\interfaces\IRenderer;

//автозагрузчик
spl_autoload_register([new AutoLoad, 'LoadClass']);
// автозагрузчик twig (подключение)
require_once '../vendor/autoload.php';

try {
    $controllerName = $_GET['c'] ?: 'product';
    $actionName = $_GET['a'];

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . 'Controller';
    if(class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    //  $controller = new $controllerClass(new app\engine\TwigRender());

    } else {
        throw new \Exception("контроллер не существует" , 404);
    }

    $controller->runAction($actionName);

} catch(\Exception $e) {
    var_dump($e);
}












