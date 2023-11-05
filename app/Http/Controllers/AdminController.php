<?php

namespace App\Http\Controllers;
use App\RMVC\DB\DB;
use App\RMVC\Route\Route;
use App\RMVC\View\View;

class AdminController extends Controller{

    public function index(){
        return View::view('admin.index');
    }

    public function category_create(){
        return View::view('admin.category_create');
    }

    public function category_store(){
        $conn = DB::$conn;

        $sql = "INSERT INTO categories (category_title, image) VALUES (?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$_POST['title'], $_POST['image']]);

        Route::redirect('/category/create');
    }

    public function product_store(){
        $conn = DB::$conn;

        $sql = "INSERT INTO products (product_title, price, product_image, description, category_id, subcategory_id, colors) VALUES (?,?,?,?,?,?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$_POST['title'], $_POST['price'], $_POST['image'], $_POST['description'], $_POST['category_id'], $_POST['subcategory_id'],$_POST['colors']]);

        Route::redirect('/product');
    }

    public function product_create(){
        $conn = DB::$conn;
        $result = $conn->query("SELECT * FROM categories");
        $categories = array();
        while($row = $result->fetch_assoc()){
            $categories[$row['id']] = $row['category_title'];
        }

        $result = $conn->query("SELECT products.product_title, categories.category_title FROM products JOIN categories ON products.category_id = categories.id");
        $products = array();
        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        return View::view('admin.product_create', compact('products'));
    }

}