<?php

namespace App\RMVC\DB;
use mysqli;
use PDO;
use PDOException;

class DB {

    public static PDO $conn;

    public static function start(){

        $host     = 'localhost';
        $db_name       = 'ecom';
        $user     = 'root';
        $password = '';
        $port     = 3306;
        $charset  = 'utf8mb4';

        // $db = new mysqli($host, $user, $password, $db, $port);
        // $db->set_charset($charset);
        // $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
        // self::$conn = $db;

        self::$conn = new PDO("mysql:dbname=".$db_name.";host=".$host, $user, $password);

    }

    public function insert(string $table, array $data): bool{
        //Разбиваем на ключи data
        $fields = array_keys($data);
        //Делаем колонки
        $colums = implode(', ',$fields);
        //Делаем бинды
        $binds =  implode(', ', array_map(fn ($field) => ":$field", $fields));
        //Объединяем в SQL запрос
        $sql = "INSERT INTO ".$table." ($colums) VALUES ($binds)";
        
        $stmt = self::$conn->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (PDOException $error) {
            echo $error."<br>";
            return false;
        }
        
        return true;
        
    }

    public static function update(string $table, array $data, array $where = array()): bool{
        //Разбиваем на ключи data
        $fields = array_keys($data);
        //Делаем бинды
        $binds =  implode(', ', array_map(fn ($field) => "$field=:$field", $fields));
        //Объединяем в SQL запрос

        //Проверяем WHERE
        if(count($where) > 0){
            //Делаем WHERE
            $data = array_merge($data, $where);
            $where_keys = array_keys($where);
            $where_string = implode(' AND ', array_map(fn ($field) => "$field=:$field", $where_keys));
            $sql = "UPDATE ".$table." SET $binds WHERE $where_string";
        }
        else {
            $sql = "UPDATE ".$table." SET $binds";
        }

        $stmt = self::$conn->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (PDOException $error) {
            echo $error."<br>";
            return false;
        }
        
        return true;
        
    }

    public static function select(string $table, array $fields, array $where = array()): bool|array{
        //Объединяем массив $fields в строку
        $fields_string =  implode(', ', $fields);
        $data = array();

        //Проверяем WHERE
        if(count($where) > 0){
            //Делаем WHERE
            $data = array_merge($data, $where);
            $where_keys = array_keys($where);
            $where_string = implode(' AND ', array_map(fn ($field) => "$field=:$field", $where_keys));
            $sql = "SELECT $fields_string FROM ".$table." WHERE $where_string";
        }
        else {
            $sql = "SELECT $fields_string FROM ".$table;
        }

        $stmt = self::$conn->prepare($sql);

        try {
            $stmt->execute($data);
            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo $error."<br>";
            return false;
        }
        
    }

    public static function delete(string $table, array $where): bool{

         $data = array();
 
         //Проверяем WHERE
         if(count($where) > 0){
             //Делаем WHERE
             $where_keys = array_keys($where);
             $where_string = implode(' AND ', array_map(fn ($field) => "$field=:$field", $where_keys));
             $sql = "DELETE FROM ".$table." WHERE $where_string";
         }
         else {
             return false;
         }
         
         $stmt = self::$conn->prepare($sql);
 
         try {
             $stmt->execute($where);
             return true;
         } catch (PDOException $error) {
             echo $error."<br>";
             return false;
         }       
    }

}