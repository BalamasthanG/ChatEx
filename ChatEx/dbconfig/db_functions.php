<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_connection.php';
class DB_Functions {

    private $db;
    private $conn;
   
    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->conn = $this->db->connect();
    }

    
    function __destruct() {
        // disconnecting to database
        $this->db = new DB_Connect();
        $this->db->close();
    }

    //used to register the user
    function registerUser($user_object){
      
      $sqli="INSERT INTO register_user(Name,Mobile,E_mail,Password) 
              VALUES('$user_object->name','$user_object->mobile','$user_object->email',password('$user_object->password'))";
      $result = mysqli_query($this->conn,$sqli);
      if ($result) {
        return true;
      } else {      
        return false;
      }
    }

    function findFriends($name){
      $sqli = "SELECT Name,Mobile FROM register_user WHERE name like '$name%'";
      $result = mysqli_query($this->conn,$sqli);
       if ($result) {
        return $result;
      } else {      
        return false;
      }
      
    }

  }
?>