<?php

namespace App\Http\Controllers;
use App\RMVC\DB\DB;

class ApiController extends Controller{

    public function getSubcategories($ctg_id){
        $conn = DB::$conn;
        $subcategories = null;
        $sql = "SELECT * FROM subcategories WHERE category_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$ctg_id]);
        $result = $stmt->get_result();
        $subcategories = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($subcategories);
    }

}