<?php
class DB_Connect {  
    function __construct() {
 
    }

     function __destruct() {
        // $this->close();
    }
 
     public function connect() {
        require_once $_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_config.php';
        $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        mysql_select_db(DB_DATABASE);
        return $con;
    }

    public function close() {
        mysql_close();
    }
 
} 
?>