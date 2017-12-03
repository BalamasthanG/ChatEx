<?php
session_start();
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
      $tbleName = $user_object->name.$user_object->mobile;
      $create = "CREATE table $tbleName(Slno int auto_increment not null, friends_mobile bigint not null,". 
      "primary key(Slno,friends_mobile))";
      $create_result = mysqli_query($this->conn,$create);
      //echo $create_result;
      $result = mysqli_query($this->conn,$sqli);
      if ($result) {
        return true;
      } else {      
        return false;
      }
    }

    function findFriends($name){
      $tablename = $_SESSION['sessionId'].$_SESSION['mobile'];
      $sqli = "SELECT Name,Mobile FROM register_user WHERE name like '$name%' AND
      Mobile NOT IN (SELECT friends_mobile from $tablename)";
      $result = mysqli_query($this->conn,$sqli);
       if ($result) {
        return $result;
      } else {      
        return false;
      }
    }
    
    function showMember($mobile){
      $sqli = "SELECT Name,Image FROM imagesdp WHERE Mobile  = $mobile";
      $result = mysqli_query($this->conn,$sqli);
       if ($result) {
        return $result;
      } else {      
        return false;
      }
    }

    function loginAuth($mobile,$password){
      $sqli = "SELECT Name FROM register_user WHERE Mobile = '$mobile' AND Password = password('$password')";
      $result = mysqli_query($this->conn,$sqli);
      if($result){
        return $result;
      }else{
        return false;
      }
    }

    function addFriend($mobile){
      $tablename = $_SESSION['sessionId'].$_SESSION['mobile'];
      $sqli = "INSERT INTO $tablename(friends_mobile)  VALUES ($mobile)";
      $result = mysqli_query($this->conn,$sqli);
      if($result){
        return $result;
      }else{
        return false;
      }
    }

    function addedFriends($tablename){
      $sqli = "SELECT Name, Mobile FROM register_user WHERE Mobile IN (SELECT friends_mobile FROM $tablename )";
      $result = mysqli_query($this->conn,$sqli);
      if($result){
        return $result;
      }else{
        return false;
      }
    }

    function deleteFriend($mobile){
      $tablename = $_SESSION['sessionId'].$_SESSION['mobile'];
      $sqli = "DELETE FROM $tablename WHERE friends_mobile = $mobile";
      $result = mysqli_query($this->conn,$sqli);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    function createPing($tablename){
      $sqli = "SELECT * from information_schema.tables where table_schema ='chatex' and table_name = '$tablename'";
      $ex = mysqli_query($this->conn,$sqli);
      if($ex){
        $row = mysqli_num_rows($ex);
      }
      
      if($row){
         return "added already ";
      }else{
        $create = "CREATE table $tablename(Slno int auto_increment not null, message varchar(256) not null,". 
      "sender bigint, receiver bigint, read_status int,primary key(Slno))";
          $result = mysqli_query($this->conn,$create);
          if($result){
            return true;
          }else{
            return false;
          }
      }
    }

    function wholeList($tablename){
      $mobile = $_SESSION['mobile'];
      $sqli = "SELECT Name,Mobile FROM register_user WHERE
      Mobile NOT IN (SELECT friends_mobile from $tablename) AND Mobile <> $mobile";
      $result = mysqli_query($this->conn,$sqli);
       if ($result) {
        return $result;
      } else {      
        return false;
      }
    }

  }
?>