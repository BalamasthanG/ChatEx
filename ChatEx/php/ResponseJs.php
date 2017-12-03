<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_functions.php');
//get the param from js
 $paramId = $_REQUEST['paramId'];
 $paramValue = $_REQUEST['paramValue'];
 if(($paramId == "friend_search")&&( $paramValue != '')){
 	friendList($paramValue);
 }elseif (($paramId == "member")&&( $paramValue != '')) {
 	# code...
 	showMember($paramValue);
 }elseif(($paramId == "addFriend")&&($paramValue !='')){
 	addFriend($paramValue);
 }elseif (($paramId === "unfriend")&&($paramValue !='')) {
 	deleteFriend($paramValue);
 }elseif (($paramId === "ping")&&($paramValue !='')) {
 	# code...
 	
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
			echo "<button type='button' id='addFriend' value=".$mobile." onclick="."callEvent(this,'addFriendResp')"."> Add</button></li>";
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
		echo "<ul>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<li>".$row['Name']." ".$row['Mobile']." 
			<button type='button' id='member' value=".$row['Mobile']." onclick="."callEvent(this,'member_card')"."> Add</button></li>";
		}
		echo "</ul>";
	}else{
		echo "Not found";
	}
 }

 function addFriend($friendMobile){
 	$getDb = new DB_Functions();
 	$result = $getDb->addFriend($friendMobile);
 	if($result){
 		$userMobile = $_SESSION['mobile'];
 		if($userMobile < $friendMobile){
 			$table = "ping".$userMobile.$friendMobile;
 		}else{
 			$table = "ping".$friendMobile.$userMobile;
 		}
 		$getDb = new DB_Functions();
 		$res = $getDb->createPing($table);
 		if($res){
 			echo "created";
 		}else{
 			echo "fail";
 		}
 		echo "added";
 	}else{
 		echo "Something went wrong!";
 	}
 }
 function deleteFriend($mobile){
 	$getDb = new DB_Functions();
 	$result = $getDb->deleteFriend($mobile);
 	if($result){
 		echo "success";
 	}else{
 		echo "fail";
 	}
 }

?>