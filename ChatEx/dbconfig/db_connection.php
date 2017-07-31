<?php
class DB_Connect {  
    function __construct() {
 
    }

     function __destruct() {
        // $this->close();
    }
 
     public function connect() {
        require_once $_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_config.php';
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
        if(mysqli_connect_errno()){
            echo "failed".mysqli_connect_error();
        }
        return $con;
    }

    public function close() {
        mysqli_close();
    }
 
} 
?>