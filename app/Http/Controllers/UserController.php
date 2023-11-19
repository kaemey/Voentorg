<?php

namespace App\Http\Controllers;
use App\RMVC\DB\DB;
use App\RMVC\Route\Route;
use App\RMVC\View\View;
use PDO;

class UserController extends Controller{

    public function reg(){
        $error = null;
        unset($_SESSION['regerror']);

        if ($_POST['password'] !== $_POST['repassword']){
            $error = "Пароли не совпадают";
        }

        if (($_POST['login'] == '') && ($_POST['password'] == '') && ($_POST['first_name'] == '') && ($_POST['second_name'] == '')){
            $error = "Не все поля заполнены";
        }

        if (strlen($_POST['login']) < 4){
            $error = "Длина логина должна быть больше 3";
        }

        if ($_POST['phone'] == ''){
            $error = "Введите номер телефона";
        }

        if (strlen($_POST['password']) < 8){
            $error = "Пароль должен содержать от 8 символов";
        }

        if (strlen($_POST['email']) < 4){
            $error = "Введите корректный email";
        }

        if (!strpos($_POST['email'], "@")){
            $error = "Введите корректный email";
        }

        if ($error == null){
            $conn = DB::$conn;

            $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
            $stmt->execute([$_POST['login']]);
            
            if ($stmt->fetch() == null){
                $token = self::generate_token();
                $_SESSION['token'] = $token;
        
                $sql = "INSERT INTO users (login, email, password, first_name, second_name, token) VALUES (?,?,?,?,?,?)";
                $stmt= $conn->prepare($sql);
                $stmt->execute([$_POST['login'], $_POST['email'], md5($_POST['password']), $_POST['first_name'], $_POST['second_name'], $token]);
            }
            else{
                $error = "Такой логин уже занят";
            }

        }

        if($error == null){
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['user_id'] = $conn->lastInsertId();
        }

        $_SESSION['regerror'] = $error;

        Route::redirect('/reg');
    }

    public function login(){

        $error = null;
        unset($_SESSION['loginError']);
        
        if (strlen($_POST['password']) < 8){
            $error = "Введите корректный пароль";
        }

        if (strlen($_POST['login']) < 4){
            $error = "Введите корректный логин";
        }

        if ($error == null){
            $conn = DB::$conn;
            $stmt = $conn->prepare("SELECT password, id FROM users WHERE login = ?");
            $stmt->execute([$_POST['login']]);
            $row = $stmt->fetch();
            $password = $row['password'];

            if ($password != null){
                if (md5($_POST['password']) == $password){
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['user_id'] = $row['id'];
                    $token = self::generate_token();
                    $_SESSION['token'] = $token;
                    var_dump($_POST['login']);
                    $conn->query("UPDATE users SET token = $token WHERE login='".$_POST['login']."'");
                }
                else {
                    $error = "Неверный пароль";
                }
            }
            else{
                $error = "Неверный логин";
            }
         
        }

        if($error == null){
            Route::redirect('/home');
        }
        else{
            $_SESSION['loginError'] = $error;
            Route::redirect('/login');
        }

    }

    private function generate_token(){
        mt_srand();
        return mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9);
    }

    public static function checkUser(){

        if(isset( $_SESSION['login'])){

            if (isset($_SESSION['token'])){
                $conn = DB::$conn;
                $stmt = $conn->prepare("SELECT token FROM users WHERE login = ?");
                $stmt->execute([ $_SESSION['login']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $token = $row['token'];

                if($_SESSION['token'] != $token){                 
                    UserController::logout('/home');
                }
            }
            else{
                UserController::logout('/home');
            }

        }

    }

    public static function checkAdmin(){

        if(isset( $_SESSION['login'])){

            if (isset($_SESSION['token'])){
                $conn = DB::$conn;
                $stmt = $conn->prepare("SELECT token, admin FROM users WHERE login = ?");
                $stmt->execute([$_SESSION['login']]);
                $row = $stmt->fetch();
                $token = $row['token'];

                if($_SESSION['token'] != $token){                 
                    UserController::logout();
                }

                if($row['admin'] != 1){
                    UserController::logout();
                }
            }
            else{
                UserController::logout();
            }

        }

    }    

    public static function logout($link = '/login'){
        unset($_SESSION['token']);
        unset($_SESSION['login']);
        Route::redirect($link);
    }

}