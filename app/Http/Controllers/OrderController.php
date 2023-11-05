<?php

namespace App\Http\Controllers;

use App\RMVC\View\View;
use App\RMVC\DB\DB;
use App\RMVC\Route\Route;
use DateTime;
use DateTimeZone;

class OrderController extends Controller
{

    public function do_order()
    {
        return View::view('user.do_order');
    }

    public function process_order()
    {
        //Ищем id пользователя по токену (безопасности ради)
        $conn = DB::$conn;
        $stmt = $conn->prepare("SELECT id FROM users WHERE token = ?");
        $stmt->bind_param("s", $_SESSION['token']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (isset($row['id'])) {
            //Добавляем заказ в базу
            $stmt = $conn->prepare("INSERT INTO orders (user_id, products, date) VALUES (?,?,?)");

            $date = new DateTime();
            $date->setTimezone(new DateTimeZone("Europe/Moscow"));
            $date = $date->format("Y-m-d H:i:s");

            $stmt->bind_param("iss", $row['id'], $_POST['products'], $date);
            $stmt->execute();
            Route::redirect('order_success/'.$stmt->insert_id);
        }

    }

    public function order_success($order_id){
        return View::view('user.order_success', compact('order_id'));
    }

}