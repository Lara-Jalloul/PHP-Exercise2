<?php

namespace App\Classes;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connection
{   
    public function connect() 
    {
        $dotEnv = Dotenv::createImmutable(dirname(__DIR__,2));
        $dotEnv->load();

        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        

        try {
            $conn = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],$username, $password );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return null;
    }

//     public function query($sql)
//   {
//     $this->stmt = $this->dbh->prepare($sql);
//   }

//   public function bind($param, $value, $type = null)
//   {
//     if (is_null($type)) {
//       switch (true) {
//         case is_int($value):
//           $type = PDO::PARAM_INT;
//           break;
//         case is_bool($value):
//           $type = PDO::PARAM_BOOL;
//           break;
//         case is_null($value):
//           $type = PDO::PARAM_NULL;
//           break;
//         default:
//           $type = PDO::PARAM_STR;
//       }
//     }

//     $this->stmt->bindValue($param, $value, $type);
//   }

//   public function execute()
//   {
//     return $this->stmt->execute();
//   }

//   public function resultSet()
//   {
//     $this->execute();
//     return $this->stmt->fetchAll(PDO::FETCH_OBJ);
//   }

//   public function single()
//   {
//     $this->execute();
//     return $this->stmt->fetch(PDO::FETCH_OBJ);
//   }

//   public function rowCount()
//   {
//     return $this->stmt->rowCount();
//   }

}