<?php

namespace App\Http\Controllers;

use App\RMVC\DB\DB;
use App\RMVC\Route\Route;
use App\RMVC\View\View;
use PDO;

class AdminController extends Controller
{

    public function index()
    {
        //Ищем пользователя
        $conn = DB::$conn;
        $stmt = $conn->prepare("SELECT * FROM orders JOIN users ON orders.user_id = users.id WHERE orders.status = ?");
        $stmt->execute(['Создан']);

        $orders = array();
        
        while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
            $products = array();

            $order_id = $row['order_id'];
            //Ищем продукты по заказам пользователя
            $order = explode(",", $row['products']);

            foreach($order as $pos){
                $pos = explode(':', $pos);
                $product_id = $pos[0];
                $count = $pos[1];

                $stmt= $conn->prepare("SELECT * FROM products WHERE product_id=?");
                $stmt->execute([$product_id]);
                $subrow = $stmt->fetch();

                $products[] = (object)['content' => $subrow, 'count' => $count];  
            }

            $user = (object)['first_name' => $row['first_name'], 'second_name' => $row['second_name'], 
            'phone' => $row['phone'],  'city' => $row['city'], 'adress' => $row['adress']];

            $orders[] = (object)['products' => $products, 'id' => $order_id, 'status' => $row['status'], 'user' => $user];
        }

        return View::view('admin.index', compact('orders'));
    }

    public function category_create()
    {
        return View::view('admin.category_create');
    }

    public function category_store()
    {
        $conn = DB::$conn;

        $sql = "INSERT INTO categories (category_title, image) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['title'], $_POST['image']]);

        Route::redirect('/category/create');
    }

    public function product_store()
    {
        $conn = DB::$conn;

        $sql = "INSERT INTO products (product_title, price, product_image, description, category_id, subcategory_id, colors) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['title'], $_POST['price'], $_POST['image'], $_POST['description'], $_POST['category_id'], $_POST['subcategory_id'], $_POST['colors']]);

        Route::redirect('/product');
    }

    public function product_create()
    {
        return View::view('admin.product_create');
    }

    public function product_select(){
        $conn = DB::$conn;
        $stmt = $conn->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        return View::view('admin.product_select', compact('products'));
    }

    public function product_edit($product_id){
        $conn = DB::$conn;
        $stmt = $conn->query("SELECT * FROM products WHERE product_id = $product_id");
        $product= $stmt->fetch();

        return View::view('admin.product_edit', compact('product'));
    }

}