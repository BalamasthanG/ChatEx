<?php
class DB_Functions {

    private $db;

   
    function __construct() {
        include_once $_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_connection.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    
    function __destruct() {
        include_once $_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_connection.php';
        // disconnecting to database
        $this->db = new DB_Connect();
        $this->db->close();
    }

    function registerUser($user_object){
      include_once $_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_connection.php';
      $sqli="INSERT INTO register_user(Name,Email,Password,Mobile) 
              VALUES('$user_object->name','$user_object->email',password('$user_object->password'),'$user_object->mobile')";
      $result = mysql_query($sqli);
      if ($result) {
        return true;
      } else {      
        return false;
      }
    }
  }
?>