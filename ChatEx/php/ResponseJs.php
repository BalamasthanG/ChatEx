<?php
include($_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_functions.php');
//get the param from js
 $paramId = $_REQUEST['paramId'];
 $paramValue = $_REQUEST['paramValue'];
 if(($paramId == "friend_search")&&( $paramValue != '')){
 	friendList($paramValue);
 }

 function friendList($paramValue){
	$name = $paramValue;
	$getDb = new DB_Functions();
	$result = $getDb->findFriends($name);
	if($result){
		while ($row = mysqli_fetch_array($result)) {
			echo "<ul>";
			echo "<li>".$row['Name']." ".$row['Mobile']." <button type='button' id='member' onclick=''> Ping</button></li>";
			echo "</ul>";
		}
	}else{
		echo "Not found";
	}
 }

?>