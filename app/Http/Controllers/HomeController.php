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

        $conn = DB::$conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param("s", $_SESSION['login']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return View::view('home.profile', compact('data'));
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