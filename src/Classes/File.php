<?php

namespace App\Classes;

use PDO;
use PDOException;


class File
{
   protected $conn;

    public function __construct()
    {
        $db = new Connection();
        $this->conn = $db->connect();
    }

    

    // public function getBlogsWithoutContent($page, $limit, $id)
    // {
    //     $start = ($page - 1) * $limit;
    //     return $this->Blog->getBlogsWithoutContent($start, $limit, $id);
    // }
    
    // public function getTotalBlogs()
    // {
    //     return $this->Blog->countBlogs();
    // }

}
