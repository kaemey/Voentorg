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
        DB::insert('categories',$_POST);

        Route::redirect('/admin/category/edit');
    }

    public function category_select(){
        return View::view('admin.category_select');
    }

    public function category_edit($category_id){
        $category = DB::select('categories',['*'],['id'=>$category_id])[0];
        $allSubcategories = DB::select('subcategories',['*']);
        $mySubcategories = DB::select('subcategories',['subcategory_id'],['category_id' => $category_id]);
        $mySubcategoriesIds = array();
        foreach($mySubcategories as $mySubcategory){
            $mySubcategoriesIds[] = $mySubcategory['subcategory_id'];
        }
        return View::view('admin.category_edit', compact('category', 'allSubcategories', 'mySubcategoriesIds'));
    }

    public function category_update($category_id){
        //Ищем подкатегории в этой категории, чтобы узнать, какие из них не выбраны.
        $subcategories = DB::select('subcategories',['subcategory_id'],['category_id'=>$category_id]);
        $ids = array();
        foreach($subcategories as $subcategory){
            $ids[] = $subcategory['subcategory_id'];
        }
        //Ищем подкатегории, что были удалены из тех, что были в категории, чтобы обнулить им категорию.
        $subctgsForDeletingThisCatId = array_diff($ids, $_POST['subcategories']);
        //Ищем подкатегории, что были добавлены в категорию, чтобы изменить им категорию.
        $subctgsForAddingThisCatId = array_diff($_POST['subcategories'], $ids);

        foreach($subctgsForDeletingThisCatId as $id){
            DB::update('subcategories',['category_id' => 0], ['subcategory_id'=> $id]);
        }

        foreach($subctgsForAddingThisCatId as $id){
            DB::update('subcategories',['category_id' => $category_id], ['subcategory_id'=> $id]);
        }

        DB::update('categories',['category_title' => $_POST['title']], ['id'=> $category_id]);
        Route::redirect("/admin/category/edit");
    }

    public function category_delete($category_id){
        DB::delete('categories', ['id' => $category_id]);
        Route::redirect("/admin/category/edit");
    }

    public function subcategory_create()
    {
        return View::view('admin.subcategory_create');
    }

    public function subcategory_store()
    {
        DB::insert('subcategories', $_POST);

        Route::redirect('/admin/subcategory/edit');
    }

    public function subcategory_edit($subcategory_id)
    {
        $subcategory = DB::select('subcategories', ['*'], ['subcategory_id'=>$subcategory_id])[0];
        return View::view('admin.subcategory_edit',compact('subcategory'));
    }

    public function subcategory_update($subcategory_id){
        DB::update('subcategories', $_POST,['subcategory_id' => $subcategory_id]);
        Route::redirect('/admin/subcategory/edit');
    }

    public function subcategory_delete($subcategory_id){
        DB::delete('subcategories',['subcategory_id' => $subcategory_id]);
        Route::redirect('/admin/subcategory/edit');
    }

    public function subcategory_select(){
        $subcategories = DB::select('subcategories', ['*']);
        return View::view('admin.subcategory_select', compact('subcategories'));
    }

    public function product_store()
    {
        $conn = DB::$conn;

        $sql = "INSERT INTO products (product_title, price, product_image, description, category_id, subcategory_id, colors) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['title'], $_POST['price'], $_POST['image'], $_POST['description'], $_POST['category_id'], $_POST['subcategory_id'], $_POST['colors']]);

        Route::redirect('/admin/product/edit');
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

    public function product_update($product_id){
        DB::update('products',$_POST, ['product_id' => $product_id]);
        
        Route::redirect("/admin/product/edit");
    }

}