<?php
include($_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_functions.php');
//get the param from js
 $paramId = $_REQUEST['paramId'];
 $paramValue = $_REQUEST['paramValue'];
 if(($paramId == "friend_search")&&( $paramValue != '')){
 	friendList($paramValue);
 }elseif (($paramId == "member")&&( $paramValue != '')) {
 	# code...
 	showMember($paramValue);
 }

 function showMember($paramValue){
 	$mobile = $paramValue;
 	$getDb = new DB_Functions();
	$result = $getDb->showMember($mobile);
	if($result){
		$row = mysqli_fetch_array($result);
			echo "<div id='member_card_div'>";
			echo "<img src=data:image/jpg;base64,".base64_encode( $row['Image'] )." alt='No image'/><br><label>"
			.$row['Name']."</label><br><label>".$mobile."</label>";
			echo "</div>";
	}else{
		echo "Error";
	}
 }

 function friendList($paramValue){
	$name = $paramValue;
	$getDb = new DB_Functions();
	$result = $getDb->findFriends($name);
	if($result){
		while ($row = mysqli_fetch_array($result)) {
			echo "<ul>";
			echo "<li>".$row['Name']." ".$row['Mobile']." 
			<button type='button' id='member' value=".$row['Mobile']." onclick="."callEvent(this,'member_card')"."> Ping</button></li>";
			echo "</ul>";
		}
	}else{
		echo "Not found";
	}
 }

?>