<?php

namespace App\Http\Controllers;
use App\RMVC\Route\Route;
use App\RMVC\DB\DB;
use App\RMVC\View\View;

class HomeController extends Controller{

    public function index(){
        return View::view('home.index');
    }

    public function reg(){
        return View::view('home.reg');
    }

    public function login(){
        return View::view('home.login');
    }

    public function profile(){
        //Ищем пользователя
        $conn = DB::$conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$_SESSION['login']]);
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        //Ищем заказы пользователя
        $orders = array();
        
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->execute([$user['id']]);
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){

            $products = array();

            $order_id = $row['id'];
            //Ищем продукты по заказам пользователя
            $order = explode(",", $row['products']);

            foreach($order as $pos){
                $pos = explode(':', $pos);
                $product_id = $pos[0];
                $count = $pos[1];

                $stmt= $conn->prepare("SELECT * FROM products WHERE product_id=?");
                $stmt->execute([$product_id]);
                $subresult = $stmt->get_result();
                $subrow = $subresult->fetch_assoc();

                $products[] = (object)['obj' => $subrow, 'count' => $count];  
            }

            $orders[] = (object)['products' => $products, 'id' => $order_id, 'status' => $row['status']];
        }

        return View::view('home.profile', compact('user', 'orders'));
    }   

    public function news(){

        $conn = DB::$conn;
        $stmt = $conn->prepare("SELECT * FROM news");
        $stmt->bind_param("s", $_SESSION['login']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return View::view('home.news', compact('data'));
    }   
    

}