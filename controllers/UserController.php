<?php
namespace app\controllers;
use app\model\repositories\UserRepository;


class UserController extends Controller {

 public function actionLogin() {
     if(isset($_POST['submit'])) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if(!(new UserRepository())->auth($login, $pass)) {
            die("неправильный логин");
        } else {
            header("Location: /");
        }
     }   
 }

    public function actionLogout() {
        session_destroy();
        header("Location: /");
    }
}