<?php

namespace App\RMVC\View;
use App\RMVC\DB\DB;

class View{
    private static string $path;
    private static ?array $data;
    public static function view(string $path, array $data = []){

        self::$data = $data;

        $docPath = str_replace("public", 'resources/views/', $_SERVER['DOCUMENT_ROOT']);

        self::$path = $docPath . str_replace(".", "/", $path) . '.php';

       return self::getContent();

    }

    private static function getContent(): string{

        //Для внутренних ссылок
        $url = "http://localhost:8000/";

        //Для развертывания Каталог в шапке
        $conn = DB::$conn;
        $result = $conn->query("SELECT * FROM categories");
        $categories = array();
        while($row = $result->fetch_assoc()){
            $categories[] = $row;
        }

        extract(self::$data);

        ob_start();

        include self::$path;
        
        $content = ob_get_contents();

        ob_end_clean();
        
        //Для постоянного использования шаблона
        ob_start();

        $docPath = str_replace("public", 'resources/views/', $_SERVER['DOCUMENT_ROOT']);
        
        include  $docPath . 'templates\main.php';

        $html = ob_get_contents();

        ob_end_clean();

        return $html;

    }
}