<?php

namespace App\Classes;

use PDO;
use PDOException;


class User
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

   public function findUserByEmail(string $umail)
  {
     try
      {
         $query = "SELECT * FROM users WHERE email = :umail";
         $stmt = $this->conn->prepare($query);
         $stmt->execute(array( ':umail'=>$umail));
         $stmt->fetch(PDO::FETCH_ASSOC); 
        
          if($stmt->rowCount() > 0)
          {
             return true;
            }else
            {
               return false;
            }
         }catch(PDOException $e){
            echo $e->getMessage();
         }
   }

public function findUserByName(string $uname)
  {
   try
   {
      $query = "SELECT * FROM users WHERE username = :uname";
      $stmt = $this->conn->prepare($query);
      $stmt->execute(array( ':uname'=>$uname));
      $stmt->fetch(PDO::FETCH_ASSOC); 
     
       if($stmt->rowCount() > 0)
       {
          return true;
         }else
         {
            return false;
         }
      }catch(PDOException $e){
         echo $e->getMessage();
      }
  }
    
    public function login(string $uname, string $umail, string $upass)
    {
       try
       {
         $query = "SELECT * FROM users WHERE username=:uname OR email=:umail LIMIT 1";
         $stmt = $this->conn->prepare($query);
         $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
         $userRow=$stmt->fetch(PDO::FETCH_ASSOC); 
         
          if($stmt->rowCount() > 0)
          {
             if( password_verify($upass, $userRow['password']))
             {
                session_start();
                $_SESSION['username'] = $userRow['username'];
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
               }else
               {
                 
                  return false;
               }
            }
         }catch(PDOException $e)
         {
            echo $e->getMessage();
         }
      }

      public function register(string $username, string $email, string $password)
    {
       try
       {
           $new_password = password_hash($password, PASSWORD_DEFAULT);
   
           $query = "INSERT INTO users (username,email,password) VALUES (:username, :email, :password)";
           $stmt = $this->conn->prepare($query);
           $stmt->bindparam(":username", $username);
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":password", $new_password);   

           $stmt->execute(); 
         //   echo "New record created successfully";
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
}

 