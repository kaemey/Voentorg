<?php

namespace App\RMVC\DB;
use mysqli;

class DB {

    public static mysqli $conn;

    public static function start($title = "test.db"){

        $host     = 'localhost';
        $db       = 'ecom';
        $user     = 'root';
        $password = '';
        $port     = 3306;
        $charset  = 'utf8mb4';

        $db = new mysqli($host, $user, $password, $db, $port);
        $db->set_charset($charset);
        $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
        self::$conn = $db;

    }

}