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

    public function redirect($url)
   {
       header("Location: $url");
   }

    public function InsertFile( $btitle,  $boverview,  $bcontent, $bdate, $user_session) {
        try{
            $query = 'INSERT INTO blog (title, overview, content, date_of_publishing, id_user) VALUES (:btitle, :boverview, :bcontent, :bdate, :user_session)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":btitle", $btitle);
        $stmt->bindparam(':boverview', $boverview);
        $stmt->bindparam(':bcontent', $bcontent);
        $stmt->bindparam(':bdate', $bdate);
        $stmt->bindparam(':user_session', $user_session);
        $stmt->execute(); 
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

public function updateBlog($btitle,  $boverview,  $bcontent, $bdate, $blog_session){
    try{
        $query = 'UPDATE blog SET title=:btitle, overview=:boverview, content=:bcontent, date_of_publishing=:bdate WHERE blog_id=:blog_session';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(':btitle', $btitle);
        $stmt->bindparam(':boverview',$boverview );
        $stmt->bindparam(':bcontent', $bcontent);
        $stmt->bindparam(':bdate', $bdate);
        $stmt->bindparam(':blog_session', $blog_session);
        $res = $stmt->execute(); 
        if ($res) {
          return true;
      }else {
          return false;
        }
}catch(PDOException $e){
    echo $e->getMessage();
}
}

public function deleteBlog($blog_session){
    try{
        $query = 'DELETE FROM blog WHERE blog_id=:blog_session';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(':blog_session', $blog_session);
        $res = $stmt->execute();
        if($res) {
          return true;
        } else {
          return false;
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }

}


public function getFiles(){
    try{
    $query = 'SELECT * FROM blog';
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC); 
    if($stmt->rowCount() > 0){
        session_start();
        $_SESSION['blog'] = $userRow['blog_id'];
        return true;
    }else{
        return false;
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
}
  


}
