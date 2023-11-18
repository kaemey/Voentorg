<?php

namespace App\Http\Controllers;

use App\RMVC\Route\Route;
use App\RMVC\DB\DB;
use App\RMVC\View\View;
use PDO;

class HomeController extends Controller
{

    public function index()
    {
        return View::view('home.index');
    }

    public function reg()
    {
        return View::view('home.reg');
    }

    public function login()
    {
        return View::view('home.login');
    }

    public function profile()
    {
        //Ищем пользователя
        $conn = DB::$conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$_SESSION['login']]);
        $user = $stmt->fetch();

        //Ищем заказы пользователя
        $orders = array();

        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->execute([$user['id']]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $products = array();

            $order_id = $row['order_id'];
            //Ищем продукты по заказам пользователя
            $order = explode(",", $row['products']);

            foreach ($order as $pos) {
                $pos = explode(':', $pos);
                $product_id = $pos[0];
                $count = $pos[1];

                $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
                $stmt->execute([$product_id]);
                $subrow = $stmt->fetch();

                $products[] = (object) ['obj' => $subrow, 'count' => $count];
            }

            $orders[] = (object) ['products' => $products, 'id' => $order_id, 'status' => $row['status']];
        }

        return View::view('home.profile', compact('user', 'orders'));
    }

    public function profile_update()
    {

        $data = array();

        if (!strpos($_POST['email'], "@")){
            Route::redirect('/profile');
        }

        if ($_POST['firstname'] != "") {
            $data['first_name'] = $_POST['firstname'];
        }

        if ($_POST['secondname'] != "") {
            $data['second_name'] = $_POST['secondname'];
        }

        if ($_POST['city'] != "") {
            $data['city'] = $_POST['city'];
        }

        if ($_POST['adress'] != "") {
            $data['adress'] = $_POST['adress'];
        }

        if ($_POST['email'] != "") {
            $data['email'] = $_POST['email'];
        }
    
        DB::update('users', $data, ['id'=> $_SESSION['user_id']]);

        Route::redirect('/profile');
    }

    public function news()
    {

    }


}