<?php
include($_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_functions.php');
session_start();
echo $_SESSION['sessionId'];
$showObject = new FriendSearch();
$showObject->showFriends();
$showObject->wholeList();
Class FriendSearch {
	function showFriends(){
	$tablename = $_SESSION['sessionId'].$_SESSION['mobile'];
	$getDb = new DB_Functions();
		$result = $getDb->addedFriends($tablename);
		if($result){
			echo "<span id='added_list'>";
			echo "<label><center>Friend List</center></label>";
			echo "<ul>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<li>".$row['Name']." ".$row['Mobile']." 
				<button type='button' id='ping' value=".$row['Mobile']." onclick=".$this->pingPage($row['Name'])."> Ping</button>
				<button type='button' id='unfriend' value=".$row['Mobile']." onclick="."callEvent(this,'reload')".">unfriend</button></li>";
			}
			echo "</ul>";
			echo "</span>";
		}else{
			echo "Not found";
		}
	}
	function wholeList(){
		$tablename = $_SESSION['sessionId'].$_SESSION['mobile'];
		$getDb = new DB_Functions();
		$result = $getDb->wholeList($tablename);
		if($result){
			echo "<span id='whole_list'>";
			echo "<label><center>You can add</center></label>";
			echo "<ul>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<li>".$row['Name']." ".$row['Mobile']." 
				<button type='button' id='addFriend' value=".$row['Mobile']." onclick="."callEvent(this,'addFriendResp')"."> Add</button>";
			}
			echo "</ul>";
			echo "</span>";
		}		
	}
	function pingPage($chatName){
		header('location:PingPage.php?opener='.$chatName);
	}
}
?>
<html>
<head>
<script type="text/javascript" src="/ChatEx/js/callEvent.js"></script>
<link rel="stylesheet" href="/ChatEx/css/friend_search.css" />
</head>
<body>
	<input type="text" id="friend_search" onkeyup="callEvent(this,'friend_search_response')"/>
	<p>Suggestions: <span id="friend_search_response"></span></p>
	<div id="member_card" class="overlay" onclick="overlayOff(this)">
	</div>
	<div id="addFriendResp">
	</div>
</body>
</html>
