<?php

namespace App\Http\Controllers;
use App\RMVC\DB\DB;
use App\RMVC\Route\Route;
use App\RMVC\View\View;

//КАТЕГОРИИ ВСЕГДА ДОСТУПНЫ ПОД ПЕРЕМЕННОЙ $categories

class CategoryController extends Controller{

    public function index(){
        return View::view('category.index');
    }

    public function show_ctg($ctg_id){
        $conn = DB::$conn;

        $sql = "SELECT * FROM subcategories JOIN categories ON subcategories.category_id = categories.id WHERE category_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$ctg_id]);
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){
            $subcategories[] = $row;
        }

        if (isset($subcategories)) return View::view('category.show_ctg', compact('subcategories', "ctg_id"));
        else return View::view('category.show_ctg', compact("ctg_id"));
    }    

    public function show_subctg($ctg_id, $subctg_id){
        $conn = DB::$conn;

        $sql = "SELECT * FROM products JOIN categories ON products.category_id = categories.id WHERE category_id=? AND subcategory_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$ctg_id, $subctg_id]);
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        $sql = "SELECT * FROM subcategories JOIN categories ON subcategories.category_id = categories.id WHERE category_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$ctg_id]);
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){
            $subcategories[] = $row;
        }

        if (isset($subcategories)){

            return View::view('category.show_subctg', compact('products','subcategories', 'ctg_id')); 

        }
        else {

            return View::view('category.show_subctg', compact('products', 'ctg_id'));

        }

    }    

    function show_product($ctg_id, $subctg_id, $product_id){

        $conn = DB::$conn;

        $sql = "SELECT * FROM products JOIN categories ON products.category_id = categories.id WHERE product_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$product_id]);
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        $sql = "SELECT * FROM subcategories JOIN categories ON subcategories.category_id = categories.id WHERE category_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$ctg_id]);
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){
            $subcategories[] = $row;
        }

        if (isset($subcategories)){

            return View::view('category.show_product', compact('products','subcategories', 'ctg_id')); 

        }
        else {

            return View::view('category.show_product', compact('products', 'ctg_id'));

        }

    }

}